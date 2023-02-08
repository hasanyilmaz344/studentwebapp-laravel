<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

    <title>StudentWebApp</title>
    <style>
        table,
        th,
        td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }
    </style>
    <script>
        function changeorderby(thevalue) {
            document.getElementById("orderby").value = thevalue;
            if (document.getElementById('theascdesc').value == 'ASC') {
                document.getElementById("theascdesc").value = 'DESC';
            } else {
                document.getElementById("theascdesc").value = 'ASC';
            }
            document.getElementById("filterbutton").click();
        }

        // updateuser ajax
        $(document).on('submit', '#updateuserajax', function(e) {
            alert('click submit updateuserajax ilk');
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/updateuserajax',
                type: 'get',
                data: {
                    name: document.getElementById("name").value,
                    email: document.getElementById("email").value,
                    password: document.getElementById("password").value,

                },
                success: function(response) {
                    document.getElementById("buttonprofiliduzenle").click();
                    document.getElementById("wellcometext").text = "wellcome " + document.getElementById("name").value;
                    alert(response.success);
                },
                error: function(response) {}
            });
            e.preventDefault();
            return false;
        });

        // createstudentajax ajax
        $(document).on('submit', '#createstudentajax', function(e) {
            e.preventDefault();
            var thefname = document.getElementById("createfname").value;
            var thelname = document.getElementById("createlname").value;
            var thesnumber = document.getElementById("createsnumber").value;
            var thedepartment = document.getElementById("createdepartment").value;
            var theage = document.getElementById("createage").value;
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/createstudentajax',
                type: 'get',
                data: {
                    fname: thefname,
                    lname: thelname,
                    snumber: thesnumber,
                    department: thedepartment,
                    age: theage
                },
                success: function(response) {
                    document.getElementById("buttonyenistudent").click();
                    addrow(response.theid, thefname, thelname, thesnumber, thedepartment, theage);
                    alert(response.success);
                },
                error: function(response) {}
            });
            return false;
        });

        //add row
        function addrow(id, fname, lname, snumber, department, age) {
            var xTable = document.getElementById('table_data');
            var tr = xTable.insertRow(2);
            tr.innerHTML = "<th>" + id + "</th><th>" + fname + "</th><th>" + lname + "</th><th>" + snumber + "</th><th>" + department + "</th><th>" + age + "</th><th><a class='btn btn-primary' href='http://localhost:8000/studentlist?likeid=" + id + "'>Düzenle</a></th><th><button class='btn btn-danger' type='button' onclick='studentsil(" + id + ")'>Sil</button></th>";
            tr.id = id + "trid";
        }

        // updatestudent ajax
        function studentguncelle(studentid) {

            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/updatestudentajax',
                type: 'get',
                data: {
                    id: document.getElementById(studentid + "studentid").value,
                    fname: document.getElementById(studentid + "fname").value,
                    lname: document.getElementById(studentid + "lname").value,
                    snumber: document.getElementById(studentid + "snumber").value,
                    department: document.getElementById(studentid + "department").value,
                    age: document.getElementById(studentid + "age").value,
                },
                success: function(response) {
                    var buttonid = 'buttonduzenleogrenci' + studentid;
                    document.getElementById(buttonid).click();
                    //
                    var tdid = studentid + "tdfname";
                    document.getElementById(tdid).innerHTML = document.getElementById(studentid + "fname").value;
                    var tdid = studentid + "tdlname";
                    document.getElementById(tdid).innerHTML = document.getElementById(studentid + "lname").value;
                    var tdid = studentid + "tdsnumber";
                    document.getElementById(tdid).innerHTML = document.getElementById(studentid + "snumber").value;
                    var tdid = studentid + "tddepartment";
                    document.getElementById(tdid).innerHTML = document.getElementById(studentid + "department").value;
                    var tdid = studentid + "tdage";
                    document.getElementById(tdid).innerHTML = document.getElementById(studentid + "age").value;
                    alert(response.success);

                },
                error: function(response) {
                    alert('failed');
                }
            });
            return false;
        }

        // delete student ajax
        function studentsil(studentid) {
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/deletestudentajax',
                type: 'get',
                data: {
                    id: studentid
                },
                success: function(response) {
                    var rowid = studentid + 'trid';
                    var row = document.getElementById(rowid);
                    row.parentNode.removeChild(row);
                    alert(response.success);
                },
                error: function(response) {}
            });
            return false;
        }
    </script>
</head>

<body>
    <div class="alert alert-success" style="display:none"></div>
    <p value='asdasd'></p>
    <div name="maindiv" style=" padding-left: 50px; padding-right: 50px;">
        <div name="navdiv">
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" id="wellcometext"> wellcome {{ auth()->user()->name }} </a>
                    <a href="{{route('loginscreen')}}" class="btn btn-info" type="button"> Ana sayfa </a>
                    <form class="d-flex" role="search">
                        <a href="{{route('logoutuser')}}" class="btn btn-danger" type="button"> Çıkış yap </a>
                    </form>
                </div>
            </nav>
        </div>
        <div name="myaccordion">
            <div class="row">
                <div class="row">
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                        <div class="card card-body">
                            <div class="row">

                                <form id="updateuserajax" style="margin-left:auto;margin-right:auto; width: 50%;">
                                    @csrf
                                    <input type="hidden" id="userid" value="{{ auth()->user()->id }}">
                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <label>name </label>
                                            <input type="text" required="" class="form-control" id="name" placeholder="name giriniz" value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>mail </label>
                                            <input type="text" required="" class="form-control" id="email" placeholder="email giriniz" value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>password </label>
                                            <input type="text" required="" class="form-control" id="password" placeholder="password giriniz" value="">
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" type="submit" id="ajaxSubmit">update</button>
                                    </div>
                                </form>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                        <form id="createstudentajax" style="margin-left:auto;margin-right:auto; width: 50%;">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label>isim </label>
                                    <input type="text" required="" class="form-control" id="createfname" placeholder="adinizi giriniz" value="">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>soyisim </label>
                                    <input type="text" required="" class="form-control" id="createlname" placeholder="soyadinizi giriniz" value="">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>ogrenci no </label>
                                    <input type="text" required="" class="form-control" id="createsnumber" placeholder="ogrenci no giriniz" value="">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>bolum </label>
                                    <input type="text" required="" class="form-control" id="createdepartment" placeholder="bolumunuzu giriniz" value="">
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label>yas </label>
                                    <input type="text" required="" class="form-control" id="createage" placeholder="yasinizi giriniz" value="">
                                </div>
                                <div class="col-md- 2 mb-3">
                                    <button class="btn btn-primary" type="submit" id="ajaxSubmit3">create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <table id="table_data" class="table">
            @include('pagination')
        </table>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                fetch_data(page);
            });

            function fetch_data(page) {
                var l = window.location;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: "/studentlist/pagination?page=" + page,
                    data: {
                        orderby: document.getElementById('orderby').value,
                        theascdesc: document.getElementById('theascdesc').value,
                        likeid: document.getElementById('likeid').value,
                        likefname: document.getElementById('likefname').value,
                        likesnumber: document.getElementById('likesnumber').value,
                        likedepartment: document.getElementById('likedepartment').value,
                        likeage: document.getElementById('likeage').value,
                    },
                    success: function(data) {
                        $('#table_data').html(data);
                    },
                    error: function(data) {
                        alert('failed');
                    }
                });
            }
        });
        function fetch_datafilter() {
            event.preventDefault();
            var l = window.location;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "/studentlist/pagination",
                data: {
                    orderby: document.getElementById('orderby').value,
                    theascdesc: document.getElementById('theascdesc').value,
                    likeid: document.getElementById('likeid').value,
                    likefname: document.getElementById('likefname').value,
                    likelname: document.getElementById('likelname').value,
                    likesnumber: document.getElementById('likesnumber').value,
                    likedepartment: document.getElementById('likedepartment').value,
                    likeage: document.getElementById('likeage').value,
                },
                success: function(data) {
                    $('#table_data').html(data);
                },
                error: function(data) {
                    alert('failed');
                }
            });
        }
    </script>
</body>

</html>