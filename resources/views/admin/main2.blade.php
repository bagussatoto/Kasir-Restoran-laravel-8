<!DOCTYPE html>
<!--[if IE 9]> <html class="ie9 no-js" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title') | Ngapak Resto</title>
  <!-- <link rel="stylesheet" href="http://localhost:3000/css/bootstrap4/dist/css/bootstrap-custom.css?v=datetime"> -->
  <link rel="stylesheet" href="{{url('polished/css/polished.min.css')}}">
  <!-- <link rel="stylesheet" href="polaris-navbar.css"> -->
  <link rel="stylesheet" href="{{url('polished/css/open-iconic-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{url('polished/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{url('polished/css/bounce.css')}}">
  <link rel="stylesheet" href="{{url('polished/css/dataTables.bootstrap4.min.css')}}">
  <link rel="icon" href="{{url('polished/assets/fav.png')}}">
  <!-- swal -->
  <link rel="stylesheet" href="{{url('polished/js/swal/sweetalert2.min.css')}}">
  @stack('css')

  <style>
    .grid-highlight {
      padding-top: 1rem;
      padding-bottom: 1rem;
      background-color: #5c6ac4;
      border: 1px solid #202e78;
      color: #fff;
    }

    hr {
      margin: 6rem 0;
    }

    hr+.display-3,
    hr+.display-2+.display-3 {
      margin-bottom: 2rem;
    }

    .form-control {
      border-radius: 8px;
    }
    .card {
      border-radius: 8px;
    }
    .btn {
      border-radius: 8px;
    }
  </style>

</head>

<body>

    <!-- navbar -->
    @include('admin.navbar2')
    <!-- endnavbar -->

  <div class="container-fluid h-100 p-0">
    <div style="min-height: 100%" class="flex-row d-flex align-items-stretch m-0">
        <!-- sidebar -->
        @include('admin.sidebar2')
        <!-- endsidebar -->
        <div class="col-lg-10 col-md-9 p-4">
            
            @yield('content')

        </div>
      </div>
  </div>

  <!-- Logout Modal -->
  @stack('modal')
  <!-- End Logout modal -->

  
  <script src="{{url('polished/js/sweetalert.min.js')}}"></script>
  @include('sweet::alert')
  <script src="{{url('polished/js/jquery-3.3.1.slim.min.js')}}"></script>
  <script src="{{url('polished/js/popper.min.js')}}"></script>
  <script src="{{url('polished/js/bootstrap.min.js')}}"></script>
  <script src="{{url('polished/js/script.js')}}"></script>
  <script src="{{url('polished/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('polished/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{url('polished/js/datatables-demo.js')}}"></script>
  
  @stack('js')
  
</body>

</html>