<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
     function role()
    {
         return Session::get('role');

    }
    public function index()
    {


        $user_anggota = app('firebase.firestore')->database()->collection('users');
        $user = $user_anggota->document($this->role())->snapshot()->data();


        $user_anggota = app('firebase.firestore')->database()->collection('users');
        $documents = $user_anggota->where('role', '=','2')->documents();

        $array = array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                $array[] = $document->data();
            } else {
                printf('Document %s does not exist!' . PHP_EOL, $document->id());
            }
        }

        return view('anggota.index', compact('array'));



    }

    public function store(Request $request)
    {
        $auth = app('firebase.auth');

        if($request->password == $request->password_confirm) {
            try {
                $userProperties = [
                    'email' => $request->email,
                    'password' => $request->password,
                    'displayName' => $request->nama
                ];

                $createdUser = $auth->createUser($userProperties);

                $user_anggota = app('firebase.firestore')->database()->collection('users')->document($createdUser->uid);
                $user_anggota->set([
                    'NRP' => $request->nrp,
                    'email' => $createdUser->email,
                    'nama' => $createdUser->displayName,
                    'role' => "2",
                    'uid' => $createdUser->uid
                ]);


            }catch (\Throwable $e) {
                return back()->with('error', 'something went wrong');
            }


                return back()->with('success', 'berhasil menambah user');
            } else {
                return back()->with('error', 'password tak sama');
            }

    }

    public function edit($uid)
    {
        $auth = app('firebase.auth');
     $user_auth = $auth->getUser($uid);
        $user_anggota = app('firebase.firestore')->database()->collection('users');
        $user = $user_anggota->document($uid)->snapshot()->data();


        return view('anggota.edit', compact('user','user_auth'));
    }

    public function update(Request $request, $uid)
    {
        $user_anggota = app('firebase.firestore')->database()->collection('users')->document($uid);
        $user_anggota->update([
            ['path'=>'NRP','value' => $request->NRP],
            ['path'=>'nama','value' => $request->nama],
        ]);

        $properties = [
            'displayName' => $request->nama
        ];

        $auth = app('firebase.auth');
        $auth->updateUser($uid, $properties);

        return back()->with('success', 'berhasil ganti perubahan profile');
    }

    public function updatePassword(Request $request, $uid)
    {

        $auth = app('firebase.auth');
        if($request->password == $request->password_confirm)
        {
            $auth->changeUserPassword($uid, $request->password);
            return back()->with('success', 'berhasil ganti password');
        }

        return back()->with('error', 'Password tidak sama');


    }

    public function destroy($uid)
    {

            app('firebase.firestore')->database()->collection('users')->document($uid)->delete();

            $auth = app('firebase.auth');

            $auth->deleteUser($uid);

        return back()->with('success', 'berhasil menghapus');

    }


}
