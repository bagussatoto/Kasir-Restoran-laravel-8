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

  <link rel="icon" href="{{url('polished/assets/fav.png')}}">
  @stack('css')

  <style>
    .container-fluid {
      background: linear-gradient(rgba(29, 93, 221, 0.81), rgba(29, 93, 221, 0.81)),
      url('polished/assets/background.png') no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
      position: relative;
      z-index: 1;
    }

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

    .intro {
      background-color: #000;
      opacity: 70%;
      padding: 20px 20px 20px 20px;
      border-radius: 20px;
    }

  </style>

</head>

<body>

  <div class="container-fluid h-100 p-0">
     @yield('content')
  </div>
  
 
  <script src="{{url('polished/js/jquery-3.3.1.slim.min.js')}}"></script>
  <script src="{{url('polished/js/popper.min.js')}}"></script>
  <script src="{{url('polished/js/bootstrap.min.js')}}"></script>
  @stack('js')
  
</body>

</html>