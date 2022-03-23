
@extends('layouts.main')

@section('content')
@if(Session::has('firebaseUserId') && Session::has('idToken'))

<section class="section">
    <div class="section-header">Daftar Anggota</div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#storeMahasiswa">
    Tambah Anggota
  </button>
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
        <div class="row mt-3">
            <div class="col-md-12">
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
                            <table class="table table-hover table-responsive" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NRP</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($array as $a)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$a['NRP']}}</td>
                                        <td>{{$a['email']}}</td>
                                        <td>{{$a['nama']}}</td>
                                        <td>{{$a['role']}} </td>
                                        <td>
                                            <a href="{{route('anggota.edit',$a['uid'])}}" class="btn btn-warning">Edit</a>
                                            <form action="{{route('anggota.destroy',$a['uid'])}}" method="post" class="d-inline" onsubmit="return submitForm(this)">
                                                @csrf
                                                @method('delete')

                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- Modal -->
<div class="modal fade" id="storeMahasiswa" tabindex="-1" role="dialog" aria-labelledby="storeMahasiswaTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="storeMahasiswaTitle">Tambah Anggota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('anggota.store')}}" method="post">
            @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nrp">NRP</label>
                <input type="text" id="nrp" name="nrp" class="form-control" placeholder="NRP..">
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama..">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email..">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Passsword..">
            </div>
            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Konfirmasi Password..">
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </form>

      </div>
    </div>
  </div>
  {{-- end modal --}}
   <!-- Modal -->
   <div class="modal fade" id="tambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="tambahMahasiswaTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahMahasiswaTitle">Tambah Mahasiswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
            <form action="{{route('anggota.store')}}" method="post">
                @csrf

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
            </form>

      </div>
    </div>
  </div>
  {{-- end modal --}}
@endif
@endsection


@section('js')
<script>
    function submitForm(form) {
        swal({
            title: "Apakah anda yakin?",
            text: "Anggota ini akan dihapus",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then(function (isOkay) {
            if (isOkay) {
                form.submit();
            }
        });
        return false;
    }
</script>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection

