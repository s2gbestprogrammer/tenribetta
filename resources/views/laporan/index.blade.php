@extends('layouts.main')

@section('content')
@if(Session::has('firebaseUserId') && Session::has('idToken'))

<section class="section">
    <div class="section-header">Laporan Admin</div>

    <div class="section-body">

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
                                        <th>No.</th>
                                        <th>Perintah</th>
                                        <th>Informasi</th>
                                        <th class="text-center">Target</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($array as $a)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$a['perintah']}}</td>
                                        <td>{{$a['informasi']}}</td>
                                        <td>{{$a['target']}}</td>
                                        <td>
                                            <a href="{{route('printrow',$a['timestamp'])}}" class="btn btn-primary" target="_blank"><i class="fas fa-print" ></i></a>
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

@endif





  <br>

<br>

@endsection


@section('js')
<script>
    function submitForm(form) {
        swal({
            title: "Apakah anda yakin?",
            text: "Pemilih ini akan dihapus",
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

