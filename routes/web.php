<?php

use App\Http\Controllers\AnggotaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');




Route::post('/authenticate', function (Request $request) {


    $auth = app('firebase.auth');


    try {
        $signInResult = $auth->signInWithEmailAndPassword($request->email, $request->password);

        $user_anggota = app('firebase.firestore')->database()->collection('users');
        $user = $user_anggota->document($signInResult->firebaseUserId())->snapshot()->data();

        Session::put('firebaseUserId', $signInResult->firebaseUserId());
        Session::put('role', $user['uid']);
        Session::put('idToken', $signInResult->idToken());

        Session::save();

        return redirect()->route('laporan');

    }catch (\Throwable $e) {
        return redirect()->route('login')->with('error', 'Email atau passsword salah');
    }



    // return redirect()->route('laporan');
})->name('authenticate');







Route::middleware('isAdmin')->group(function () {

    route::prefix('anggota')->group(function () {
        Route::get('', [AnggotaController::class, 'index'])->name('anggota.index');
        Route::post('store', [AnggotaController::class, 'store'])->name('anggota.store');
        Route::get('edit/{uid}', [AnggotaController::class, 'edit'])->name('anggota.edit');
        Route::put('update/{uid}', [AnggotaController::class, 'update'])->name('anggota.update');
        Route::put('updatePassword/{uid}', [AnggotaController::class, 'updatePassword'])->name('anggota.updatepassword');
        Route::delete('destroy/{uid}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    });

    Route::get('/laporan', function () {
        $citiesRef = app('firebase.firestore')->database()->collection('laporan');
        $documents = $citiesRef->documents();

        $array = array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                $array[] = $document->data();
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $document->id());
            }
        }

        return view('laporan.index', compact('array'));
    })->name('laporan');




    Route::get('/printrow/{timestamp}', function ($timestamp) {

        $laporanRef = app('firebase.firestore')->database()->collection('laporan')->document($timestamp)->snapshot();

        $laporan =  $laporanRef->data();

        $chatdatas = app('firebase.firestore')->database()->collection('laporan')->document($timestamp)->collection('chatdata')->where('laporan', '=', true)->documents();

        $data_chats = array();
        foreach($chatdatas as $chatdata) {
            if ($chatdata->exists()) {
                $data_chats[] = $chatdata->data();
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $chatdata->id());
            }
        }
        return view('laporan.printrow2',compact('laporan', 'data_chats'));
        $pdf = PDF::loadview('laporan.printrow',compact('laporan', 'data_chats'))->setPaper('A4', 'potrait');
        return $pdf->stream();
    })->name('printrow');


});






Route::get('/logout', function () {
    $auth = app('firebase.auth');



    if(Session::has('firebaseUserId') && Session::has('idToken')) {
        $auth->revokeRefreshTokens(Session::get('firebaseUserId'));
        Session::forget('firebaseUserId');
        Session::forget('idToken');
        Session::save();
        return redirect()->route('login');
    } else {
        dd("belum login");
    }
})->name('logout');


