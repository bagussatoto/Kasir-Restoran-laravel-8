<?php 
// PENDAPATAN & ORDER HARI INI
$hari_ini = Carbon\Carbon::today();
$earning = App\Order::whereDate('created_at', $hari_ini)->sum('subtotal');
$today_order = App\Order::whereDate('created_at', $hari_ini)->count();

// PENDAPATAN & ORDER BULAN INI
$bulan_ini = Carbon\Carbon::now()->month;
$earning_month = App\Order::whereMonth('created_at', $bulan_ini)->sum('subtotal');
$month_order = App\Order::whereMonth('created_at', $bulan_ini)->count();

// PENDAPATAN & ORDER TAHUN INI
$tahun_ini = Carbon\Carbon::now()->year;
$earning_year = App\Order::whereYear('created_at', $tahun_ini)->sum('subtotal');
$year_order = App\Order::whereYear('created_at', $tahun_ini)->count();

// PENDAPATAN & ORDER SELAMA INI
$jml_pendapatan = App\Order::where('status_order','Beres')->sum('subtotal');
$jml_order = App\Order::where('status_order', 'Beres')->count();

 ?>
@extends('admin.main2')
@section('title','Dashboard')
@section('content')

<div class="row ">
  <div class="col-md-12 pl-3 pt-2">
      <div class="pl-3">
          <h3>Dashboard</h3>
      </div>
  </div>
</div>

<!-- start info box -->
<div class="row ">
  <div class="col-md-12 pl-3 pt-2">
      <div class="row pl-3">

        <div class="col-lg-3 col-md-6 mb-2 col-sm-6">
          <div class="card border-0 shadow-sm bg-danger text-light">
            <div class="card-body">
                <div class="media">
                  <?php
                      $orders =  App\Order::where('status_order', 'Menunggu Pembayaran')->get();
                    ?>
                    <div class="media-body">
                      <h2 class="fw-bold">{{$orders->count()}}</h2>
                      <h6>New orders!!</h6>
                    </div>
                    <span class="oi oi-bell bell p-2 fs-9 text-danger-lightest"></span>
                </div>
            </div>
            <div class="card-footer border-0 text-center p-1 bg-danger-lighter">
              <a href="{{route('cashier')}}" class="text-light">
                  More info <span class="oi oi-arrow-circle-right"></span>
              </a>
            </div>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-6 mb-2 col-sm-6">
          <div class="card border-0 shadow-sm bg-primary text-light">
            <div class="card-body">
                <div class="media">
                  <?php
                      $data = App\User::all();
                    ?>
                    <div class="media-body">
                      <h2 class="fw-bold">{{$data->count()}}</h2>
                      <h6>User Registered</h6>
                    </div>
                    <span class="oi oi-people p-2 fs-9 text-indigo-lighter"></span>
                </div>
            </div>
            <div class="card-footer border-0 text-center p-1 bg-primary-lighter">
              <a href="{{route('admin.user')}}" class="text-light">
                  More info <span class="oi oi-arrow-circle-right"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-2 col-sm-6">
          <div class="card border-0 shadow-sm bg-warning text-primary">
            <div class="card-body">
                <div class="media">
                  <?php
                      $data = App\Masakan::all();
                    ?>
                    <div class="media-body">
                      <h2 class="fw-bold">{{$data->count()}}</h2>
                      <h6>Masakan</h6>
                    </div>
                    <span class="oi oi-pie-chart p-2 fs-9 text-primary-lighter"></span>
                </div>
            </div>
            <div class="card-footer border-0 text-center p-1 bg-warning-lighter">
              <a href="{{route('admin.masakan')}}" class="text-primary">
                  More info <span class="oi oi-arrow-circle-right"></span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-2 col-sm-6">
          <div class="card border-0 shadow-sm bg-success text-light">
            <div class="card-body">
                <div class="media">
                  <?php
                      $data = App\Transaksi::all();
                    ?>
                    <div class="media-body">
                      <h2 class="fw-bold">{{$data->count()}}</h2>
                      <h6>Data Transaksi</h6>
                    </div>
                    <span class="oi oi-dollar p-2 fs-9"></span>
                </div>
            </div>
            <div class="card-footer border-0 text-center p-1 bg-success-lighter">
              <a href="{{route('admin.transaksi')}}" class="text-light">
                  More info <span class="oi oi-arrow-circle-right"></span>
              </a>
            </div>
          </div>
        </div>

      </div>
  </div>
</div>
<!-- end info box -->

<div class="col-md-12">

  <div class="row">

    <div class="col-lg-7 pl-3 pt-2 pb-2 pr-2" style="background-image: url('polished/assets/main.png') !important; background-size: 80% ; background-repeat: no-repeat; background-position: 15rem -5rem">
     <div class="greeting mt-4 pl-4">
       <h3>
        <?php 

          date_default_timezone_set("Asia/Jakarta");

            $b = time();
            $hour = date("G",$b);

            if ($hour>=0 && $hour<=11)
            {
            echo "Selamat Pagi";
            }
            elseif ($hour >=12 && $hour<=14)
            {
            echo "Selamat Siang";
            }
            elseif ($hour >=15 && $hour<=17)
            {
            echo "Selamat Sore";
            }
            elseif ($hour >=17 && $hour<=18)
            {
            echo "Selamat Petang";
            }
            elseif ($hour >=19 && $hour<=23)
            {
            echo "Selamat Malam";
            }

       ?>, {{Auth::user()->fullname}}
       </h3>
       <h4 class="text-muted w-50 fw-normal">
         Inilah yang terjadi pada Restoran anda hari ini.
       </h4>
     </div>

     <div class="row store-insight pl-4">
      <div class="col-5">
        <div>Pendapatan Hari ini</div>   
        <h4 class="fw-normal">
          Rp.{{number_format($earning),0,',','.'}}
          <p class="text-muted pt-2" style="font-size: 16px;">{{$today_order}} Orders</p>
        </h4>
      </div>
       
     </div>

     <div class="row mt-4">
       <div class="col-12">
          <div class="card border-warning-light m-4 p-2 bg-warning-light shadow-sm">
              <ul class="list-group list-group-flush">
                <li class="list-group-item bg-warning-light">
                  <span class="d-block mb-2 fw-bold"> 10 tips untuk meningkatkan penjualan !.</span>
                  <p>
                    Berikut adalah beberapa langkah dasar yang dapat Anda ambil untuk meningkatkan kinerja penjualan, mengurangi biaya penjualan, dan memastikan bisnis hebat Anda.
                  </p>
                  <a href="#" class="btn btn-link text-primary pl-0">Pelajari Lebih lanjut</a>
                </li>
                <li class="list-group-item bg-warning-light">
                  <span class="d-block mb-2 fw-bold"> Dapatkan lebih banyak pelanggan!</span>
                  <p>
                    Pelajari cara mendapatkan lebih banyak pelanggan dengan panduan langkah demi langkah dari pemasar ahli!
                  </p>
                  <a href="#" class="btn btn-link text-primary pl-0">Pelajari Lebih lanjut</a>
                </li>
                <li class="list-group-item bg-warning-light">
                  <span class="d-block mb-2 fw-bold"> Kunci agar setiap hari mendapatkan pelanggan</span>
                  <p>
                    Pelajari agar konsisten setiap hari mendapatkan pelanggan!
                  </p>
                  <a href="#" class="btn btn-link text-primary pl-0">Pelajari Lebih lanjut</a>
                </li>
              </ul>
            </div>
       </div>
     </div>
    </div>


    <div class="col-lg-5 pt-2 pb-2 bg-white shadow-sm border-left border-white">

      

      <div class="row p-4">
        <div class="col-md-6">
            <small class="fw-bold">TOTAL PENDAPATAN</small>
            <h4 class="fw-normal">Rp.{{number_format($jml_pendapatan),0,',','.'}}</h4>
        </div>
        <div class="col-md-6 text-right text-muted">
            <span class="d-block">Selama Ini</span>
            <span>{{$jml_order}} orders</span>
        </div>
      </div>

      <small class="fw-bold mx-4">PENDAPATAN BERDASARKAN WAKTU</small>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <div class="row">
              <div class="col-md-6">
                <span style="text-decoration: none !important">Hari ini</span>
                <h5 class="mt-2">Rp.{{number_format($earning),0,',','.'}}</h5>
              </div>
              <div class="col-md-6 text-right pt-3">
                <span class="text-muted">{{$today_order}} orders</span>
              </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
              <div class="col-md-6">
                <span style="text-decoration: none !important">Bulan ini</span>
                <h5 class="mt-2">Rp.{{number_format($earning_month),0,',','.'}}</h5>
              </div>
              <div class="col-md-6 text-right pt-3">
                <span class="text-muted">{{$month_order}} orders</span>
              </div>
          </div>
        </li>
        <li class="list-group-item">
          <div class="row">
              <div class="col-md-6">
                  <span style="text-decoration: none !important">Tahun ini</span>
                  <h5 class="mt-2">Rp.{{number_format($earning_year),0,',','.'}}</h5>
                </div>
                <div class="col-md-6 text-right pt-3">

                  <span class="text-muted">{{$year_order}} orders</span>
                </div>
          </div>
        </li>
      </ul>
      <div class="col-lg-12 pt-3 mx-auto">
        <div class="card shadow-sm ">
          <div class="card-header bg-primary text-light d-inline">
            <h6><b>Recently</b></h6>
          </div>
          <!-- Chart Tag -->
          <div class="card-body">
              <canvas id="chartjs-doughnut"></canvas>
          </div>
          <div class="card-footer small text-muted">Grafik</div>
        </div>
      </div>
    </div>

  </div>

</div>


<div class="col-lg-12 pt-3 mx-auto">
  <div class="card shadow-sm ">
    <div class="card-header bg-primary text-light d-inline">
      <a class="btn btn-success float-right ml-2" href="{{route('print.excel')}}"><span class="oi oi-print"></span> Export Excel</a><a class="btn btn-danger float-right" href="{{route('print.pdf')}}"><span class="oi oi-print"></span> Export PDF</a>
      <h6><b>Data Transaksi per-minggu</b></h6>
    </div>
    <!-- Chart Tag -->
    <div class="card-body">
        <canvas id="chartjs-line"></canvas>
    </div>
    <div class="card-footer small text-muted">Grafik Line</div>
  </div>
</div>


@endsection

@push('js')
<script src="{{url('polished/js/Chart.min.js')}}"></script>
<?php

$orders = App\Order::all();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
foreach ($orders as $order) {
  foreach ($order->cart->items as $key) {
    $menu = $key['item']['nama_masakan'];
  }
}

$data = App\Transaksi::join('orders', 'transactions.order_id_order', '=', 'orders.id_order')
            ->select('transactions.tanggal_transaksi', 'orders.subtotal')
            ->get();

$star_date = strtotime(date('Y-m-d'));
$date = strtotime("-10 days", $star_date);
$x = 0;
$data_tgl = "";
$data_transaksi = "";
$data_price = "";
while($x < 10) {
  $x++;
  $date = strtotime("+1 days", $date);
  $tanggal = date('Y-m-d', $date);
  $tgl = date('d M', $date);
  $jum = $data->where('tanggal_transaksi','like',$tanggal)->count();
  $price = $data->where('tanggal_transaksi','like',$tanggal)->sum('subtotal');
  $data_tgl .= "'$tgl',";
  $data_transaksi .= "'$jum',";
  $data_price .= "'$price',";

}

 ?>
 <script type="text/javascript">
   var tanggal = [<?= $data_tgl ?>];
   var transaksi = [<?= $data_transaksi ?>];
   var subtotal = [<?= $data_price ?>];

   // Grafik LINE per-minggu
   var ctxLine = document.getElementById('chartjs-line')
    var dataLine = {
      labels: tanggal,
      datasets: [{
        label: 'Transaksi',
        data: transaksi,
        borderColor: '#B5BCF3'
      }, {
        label: 'Pendapatan',
        data: subtotal,
        borderColor: '#47467A'
      }]
    }

    var myLineChart = new Chart(ctxLine, {
      type: 'line', 
      data: dataLine
    })

    // Grafik PIE data ORDEr

    var ctxDoughnut = document.getElementById('chartjs-doughnut')
    var myDoughnutChart = new Chart(ctxDoughnut, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [10,20,30],
          backgroundColor: ['#24235C', '#47467A', 'indigo']
        }],
        labels: [ 'April', 'May', 'June']
      }
    })

   // Auto Refresh Dashboard
     setTimeout(function(){
         location.reload();
     },60000); // 5000 milliseconds atau 5 seconds.
 </script>

@endpush