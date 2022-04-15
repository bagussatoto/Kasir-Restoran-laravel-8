<nav class="navbar navbar-expand  p-0">
 <a class="navbar-brand text-center col-xs-12 col-md-3 col-lg-2 mr-0" href="{{route('admin.home')}}">         <img src="{{url('polished/assets/ngapak.png')}}" alt="logo" width="120px"></a>
  <button class="btn btn-link d-block d-md-none" data-toggle="collapse" data-target="#sidebar-nav" role="button" >
    <span class="oi oi-menu"></span>
  </button>
  
  <div class="border-primary-darkest bg-primary-darkest form-control d-none d-md-block w-60 ml-3 mr-5">
    <marquee class="text-white" behavior="alternate" direction="">Selamat Datang di Halaman Backend dari Ngapak Resto.</marquee>
  </div>

  <a class="navbar-brand text-right" href="{{route('menu-masakan')}}"><span class="oi oi-book"></span> Ke Menu Masakan</a>

  <div class="dropdown d-none d-md-block pr-5">
    
    <button class="btn btn-link btn-link-primary dropdown-toggle" id="navbar-dropdown" data-toggle="dropdown">
      <span class="oi oi-person"></span> {{Auth::user()->fullname}}
    </button>
    <div class="dropdown-menu dropdown-menu-right" id="navbar-dropdown">
      <a href="#" class="dropdown-item" data-toggle="modal" data-target="#profilModal"><span class="oi oi-person"></span> Profile</a>
      <a href="{{ route('admin.user.setting') }}" class="dropdown-item"><span class="oi oi-cog"></span> Setting</a>
      <div class="dropdown-divider"></div>
      <a href="{{ route('logout') }}" class="dropdown-item logout"><span class="oi oi-account-logout"></span> Log Out</a>
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

@push('js')
<script src="{{url('polished/js/swal/sweetalert2.all.min.js')}}"></script>
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
<!-- onclick="return confirm('Sudah Diantar Waiter?')" -->
@endpush