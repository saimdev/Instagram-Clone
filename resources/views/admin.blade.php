<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('/app.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/app.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
        .table>:not(:last-child)>:last-child>* {
            border-bottom-color: #dd2a7b !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">

        {{-- Left MENU --}}

        <div class="row">
            <div class="col col-2 menu container-fluid d-flex flex-column justify-content-center align-items-center p-4" style="background: linear-gradient(0.90turn, rgba(81, 91, 212, 0.5),rgba(129, 52, 175, 0.5),rgba(221, 42, 123, 0.5), rgba(245, 133, 41, 0.5), rgba(254, 218, 119, 0.5));
            backdrop-filter: blur(0px) saturate(5%); height:100vh; border-radius:0 0.5rem 0.5rem 0;" >
                <h1 class="h1 fw-normal text-white d-flex justify-content-center mt-4" style="font-family: 'Lobster', cursive; margin-bottom: 0.5rem; font-size:4rem;">A</h1>
                <h1 class="h1 fw-normal text-white d-flex justify-content-center mt-4" style="font-family: 'Lobster', cursive; margin-bottom: 0.5rem; font-size:4rem;">D</h1>
                <h1 class="h1 fw-normal text-white d-flex justify-content-center mt-4" style="font-family: 'Lobster', cursive; margin-bottom: 0.5rem; font-size:4rem;">M</h1>
                <h1 class="h1 fw-normal text-white d-flex justify-content-center mt-4" style="font-family: 'Lobster', cursive; margin-bottom: 0.5rem; font-size:4rem;">I</h1>
                <h1 class="h1 fw-normal text-white d-flex justify-content-center mt-4" style="font-family: 'Lobster', cursive; margin-bottom: 0.5rem; font-size:4rem;">N</h1>
            </div>


            {{-- Mid Area --}}

            <div class="col col-10 p-4">
                <table class="table">
                    <thead class="text-white">
                        <tr>
                            <th>Sr No.</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Edit</th>
                            <th>See Profile</th>
                            <th>Disable User</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>
<script type="text/javascript">
    $(function () {
      
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('admin.adminshow') }}",
          columns: [
              {data: 'Id', name: 'id'},
              {data: 'Username', name: 'username'},
              {data: 'Name', name: 'name'},
              {data: 'Password', name: 'password'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
      
    });
  </script>
</html>