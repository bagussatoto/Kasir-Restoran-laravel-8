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

  <link rel="icon" href="{{url('polished/assets/fav.png')}}">
  @stack('css')

</head>
<style>
  @media screen and (max-width: 450px) {
        h1 {
          font-size: 35px;
        }
        .container {
          width: 90%;
        }
    }
    @media screen and (max-width: 550px) {
          h1 {
            font-size: 35px;
          }
      .container {
          width: 90%;
        }
    }

    @media screen and (max-width: 800px) {
          h1 {
            font-size: 35px;
          }
          .navbar-brand {
            left: -40px;
          }
      .container {
          width: 90%;
        }
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

<body>

<nav class="navbar navbar-expand p-0 bg-success-darkest sticky-top">
 <a class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2 mr-0" href="{{route('menu-masakan')}}">         <img src="{{url('polished/assets/ngapak.png')}}" alt="logo" width="120px"></a>
  
  <div class="border-success-darker bg-success-darker form-control d-none d-md-block w-60 ml-3 mr-5">
    <marquee class="text-white" behavior="alternate" direction="">Selamat Datang di Ngapak Resto, Semoga harimu Menyenangkan.</marquee>
  </div>

  <a class="navbar-brand text-right" href="{{route('shopping.cart')}}"><i class="oi oi-cart"></i> Cart <span class="badge badge-warning">{{Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a>

  <a class="navbar-brand text-right" href="{{route('history')}}"><span class="oi oi-book"></span> History</a>

  <div class="dropdown d-none d-md-block pr-5">
    
    <button class="btn btn-link btn-link-succes dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown">
      <span class="oi oi-person"></span> {{Auth::user()->fullname}}
    </button>
    <div class="dropdown-menu dropdown-menu-right" id="navbar-dropdown">
      <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profilModal"><span class="oi oi-person"></span> Profile</a>
      <div class="dropdown-divider"></div>
      <a href="#" class="dropdown-item logout"><span class="oi oi-account-logout"></span> Sign Out</a>
    </div>
  </div>
</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

@push('modal')
<div class="modal fade" id="profilModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Profile</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Your Name<h3>{{Auth::user()->fullname}}</h3>
        Your Username<h4>{{Auth::user()->username}}</h4>
        Your Email<h4>{{Auth::user()->email}}</h4>
        Your Level<h4>{{Auth::user()->level}}</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endpush

  <div class="container-fluid h-100 p-0">            
      @yield('content')
  </div>

  @stack('modal')

  <script src="{{url('polished/js/sweetalert.min.js')}}"></script>
  @include('sweet::alert')
  <script src="{{url('polished/js/jquery.min.js')}}"></script>
  <script src="{{url('polished/js/popper.min.js')}}"></script>
  <script src="{{url('polished/js/bootstrap.min.js')}}"></script>
  <script src="{{url('polished/js/swal/sweetalert2.all.min.js')}}"></script>
 @stack('js')
  <script type="text/javascript">
      $('.logout').on('click', function (e) {

        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
          title: 'Logout?',
          text: "Apakah anda yakin mau mengakhiri sesi ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya yakin!'
        }).then((result) => {
          if (result.value) {
            document.getElementById('logout-form').submit();
          }
        })

      });

  </script>
  
</body>

</html>