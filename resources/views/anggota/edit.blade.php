
@extends('layouts.main')

@section('content')
@if(Session::has('firebaseUserId') && Session::has('idToken'))
<section class="section">

    <div class="section-header">Edit Anggota</div>
    <div class="section-body">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif
        <div class="row mt-4">

            <div class="col-md-6">
                <div class="card">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                     @endif
                    <div class="card-body">
                        <form action="{{route('anggota.update', $user['uid'])}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="">NRP</label>
                                <input type="text" class="form-control" name="NRP"   placeholder="" value="{{$user['NRP']}}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" disabled placeholder="" value="{{$user['email']}}">
                            </div>
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="" value="{{$user['nama']}}">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                     @endif
                     <div class="card-header">Ganti Password</div>
                    <div class="card-body">
                        <form action="{{route('anggota.updatepassword', $user_auth->uid)}}" method="post">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <label for="">UID</label>
                                <input type="text" class="form-control" placeholder="" value="{{$user_auth->uid}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="" value="">
                            </div>
                            <div class="form-group">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirm" class="form-control" placeholder="" value="">
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

@endif
@endsection
