<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 80px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 10px;
                margin-bottom: 10px;
            }

            footer {
                position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->

        <header>
          <p>
               <b>
                {{$laporan['informasi']}} <br> <br>
                {{$laporan['perintah']}} <br> <br>
               </b>
              {{$laporan['target']}}
          </p>

        </header>



        <footer>
            Copyright &copy; <?php echo date("Y");?>
        </footer>


        <main>

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
        </main>
        <!-- Wrap the content of your PDF inside a main tag -->

    </body>
</html>




{{-- <div class="content">
    @foreach ($data_chats as $data_chat)
    <div class="chatdata" style="margin-bottom: 15px;">
        <img src="" alt="">
        <p> Nama pengirim: {{$data_chat['nama']}}</p>
        <p>Lokasi: {{$data_chat['lokasi']}}</p>
        <p>Tanggal: {{$data_chat['waktu']}}</p>
        <hr>
    </div>
    @endforeach

</div> --}}


