<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

.header, .header-space,
.footer, .footer-space {
  height: 80ox;
}
.header {
  position: fixed;
  top: 0;
}
.footer {
  position: fixed;
  bottom: 0;
}
    </style>
</head>
<body>

<table>
  <thead><tr><td>

    <div class="header-space" style="text-align: center;text-transform: capitalize;"> <p>
        <b>
         {{$laporan['informasi']}} <br>
         {{$laporan['perintah']}} <br>
        </b>
       {{$laporan['target']}}
   </p> <hr></div>
  </td></tr></thead>
  <tbody><tr><td>
    <div class="content">
        @foreach ($data_chats as $data_chat)
            <div class="chatdata" style="margin-bottom: 15px;">
                @if ($data_chat['gambar'])
                <img src="{{$data_chat['gambar']}}" alt="" width="200px" height="">
                @endif
                <p> Nama pengirim: {{$data_chat['nama']}}</p>
                <p>Lokasi: {{$data_chat['lokasi']}}</p>
                <p>Tanggal: {{$data_chat['waktu']}}</p>
                <hr>
            </div>
            @endforeach
    </div>
  </td></tr></tbody>
  <tfoot><tr><td>
    <div class="footer-space">&nbsp;</div>
  </td></tr></tfoot>
</table>

<script>
    window.print();
</script>
</body>
</html>
