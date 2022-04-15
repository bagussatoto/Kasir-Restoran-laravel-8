<?php
  $entri =  App\Order::where('status_order', 'Pending')->get();
  $cashier =  App\Order::where('status_order', 'Menunggu Pembayaran')->get();

?>
<div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p-0 collapse d-md-inline" id="sidebar-nav">

    <ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
      @if(Auth::user()->level == 'admin' || Auth::user()->level == 'owner')
      <li><a href="{{route('admin.home')}}"><span class="oi oi-home"></span> Dashboard</a></li>
      @endif
      @if(Auth::user()->level == 'admin')
      <li><a href="{{route('admin.user')}}"><span class="oi oi-people"></span> Users</a></li>
      <li><a href="{{ route('admin.masakan') }}"><span class="oi oi-puzzle-piece"></span></span> Daftar Masakan</a></li>
      <li><a href="{{route('admin.masakan.kategori')}}"><span class="oi oi-tags"></span> Kategori</a></li>
      <li><a href="{{route('daftar.discounts')}}"><span class="oi oi-dollar"></span> Manage Discounts <span class="badge badge-danger">beta</span></a></li>
      @endif

      @if(Auth::user()->level =='admin' || Auth::user()->level =='waiter')
      <li><a href="{{route('entri.order')}}"><span class="oi oi-clipboard"></span> Waiter <span class="badge badge-warning float-right">{{$entri->count()}}</span></a></li>
      @endif

      @if(Auth::user()->level =='admin' || Auth::user()->level =='kasir')
      <li><a href="{{route('cashier')}}"><span class="oi oi-bell bell"></span> Cashier <span class="badge badge-warning float-right">{{$cashier->count()}}</span></a></li>
      @endif

      @if(Auth::user()->level =='admin' || Auth::user()->level =='kasir')
      <div class="pt-4">
          <a href="#" class="pl-3 fs-smallest fw-bold text-muted">Rekap Data</a> 
          <ul class="list-unstyled">
              <li class=""><a href="{{ route('admin.order') }}"><span class="oi oi-vertical-align-top"></span>Rekap Order</a></li>
              <li><a href="{{route('admin.transaksi')}}"><span class="oi oi-dollar"></span>Rekap Transaksi</a></li>
          </ul>
      </div>
      @endif
     </ul>  
</div>