@extends('layouts.app')

@section('content')
    <table cellspacing="0" cellpadding="5" width="" border="1px">
        <thead>
            <tr>
                <th>#</th>
                <th>first name</th>
                <th>last name</th>
                <th>gender</th>
                <th>class</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="StudentData">

        </tbody>
    </table> <br>

    <form action="#" method="post" id="createStudentForm" autocomplete="off">
        <label for="">first name</label> <br>
        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name"> <br>
        <label for="">last name</label> <br>
        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="last Name"> <br>
        <label for="">gender</label> <br>
        <select name="gender" id="gender">
            <option value="">select</option>
            <option value="male">male</option>
            <option value="female">female</option>
        </select> <br>
        <label for="">Class</label> <br>
        <select name="class" id="classStudent">
            <option value="">select</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select> <br>

        <button type="button" id="createStudentButton">submit</button>
    </form>
@endsection

@push('script')
<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.9/firebase-app.js";
    import { getDatabase,set,ref,child,update,remove,onValue,get } from "https://www.gstatic.com/firebasejs/9.6.9/firebase-database.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyD0_qMbfFULJcq6QlWLcxiGWTO8e4HqIiM",
      authDomain: "laravel-firebase-42efd.firebaseapp.com",
      projectId: "laravel-firebase-42efd",
      storageBucket: "laravel-firebase-42efd.appspot.com",
      messagingSenderId: "417429614023",
      appId: "1:417429614023:web:df00f550b3b4648359bde2"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const firebase = getDatabase();


    $(document).ready(function() {
        var lastStudentId = 0;

        const dbRef = ref(getDatabase());

        get(child(dbRef, `Students/`)).then((snapshot) => {
            var tableData = [];
        if (snapshot.exists()) {
            var studentData = snapshot.val()

            $.each(studentData, function(index, value){

                if(value) {
                    tableData.push('<tr>\
                        <td>'+index+'</td>\
                        <td>'+value.first_name+'</td>\
                        <td>'+value.last_name+'</td>\
                        <td>'+value.gender+'</td>\
                        <td>'+value.class_student+'</td>\
                        <td><form method="GET" action="{{route('asd')}}">\
                            <input type="hidden" name="first_name" value='+value.first_name+'>\
                            <input type="hidden" name="last_name" value='+value.last_name+'>\
                            <input type="hidden" name="gender" value='+value.gender+'>\
                            <input type="hidden" name="class_student" value='+value.class_student+'>\
                            <button type="submit" class="btn btn-primary">ok</button></form></td>\
                        </tr>');

                        $('#StudentData').html(tableData)
                }
            })
        } else {
            console.log("No data available");
        }
        }).catch((error) => {
        console.error(error);
        });

        //create student
        $("#createStudentButton").on('click', function() {

            var studentRowData = $('#createStudentForm').serializeArray();
            var first_name = document.getElementById('firstName').value;
            var last_name = document.getElementById('lastName').value;
            var gender = document.getElementById('gender').value;
            var class_student = document.getElementById('classStudent').value;

            //Id nya bertambah 1 terus
            var studentId = lastStudentId + 1;

            //Validation

            set(ref(firebase, "Students/"+3), {
                first_name: first_name,
                last_name: last_name,
                gender: gender,
                class_student: class_student,

            })
            .then(()=> {
                alert('data has ben created')
            }).catch((err) => {
                alert(err)
            })


            //assign the student id to the laststundetid

            lastStudentId = studentId;

            console.log(studentRowData)
            return false;

        });

        //edit


    })
  </script>


@endpush
