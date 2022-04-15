@extends('layouts.main2')
@section('title','Terima Kasih')
<style>
	.img-fluid{
		filter: brightness(50%);
		object-fit: cover;
	}

	.carousel-caption {
		top: 0px;
		text-shadow: 1px 1px black;
	}

	.container {
		padding: 10px 10px 10px 10px;
		background: #fff;
		border-radius: 20px;
		position: relative;
		top: -100px;
		
	}
</style>
@section('content')

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="img-fluid d-block w-100 h-50" src="{{url('polished/assets/bg2.png')}}" alt="First slide">
      <div class="carousel-caption">
	    <h2>Terimakasih telah Memesan.</h2>
		<h1 class="text-center">Mohon Tunggu Sebentar...<span class="oi oi-loop-circular mt-4 fs-9 spin"></span></h1>
	  </div>
    </div>
  </div>
</div>

<div class="container">

	@if(session('result') == 'success')
	<div class="alert alert-success" role="alert">
	  <h4 class="alert-heading">Berhasil Memesan!</h4>Silahkan lakukan Pembayaran ke Kasir terlebih dahulu.
	  <a href="{{route('history')}}" target="_blank" class="btn btn-success btn-lg"><span class="oi oi-book"></span> LIhat Riwayat Order Anda</a>
	  <a href="{{route('delivery')}}" target="_blank" class="btn btn-info"><span class="oi oi-print"></span> Cetak</a>
	</div>
	@endif
	<div class="card border-secondary text-dark shadow-sm">
	  <div class="card-header bg-secondary">
	    <span class="btn p-0" data-toggle="collapse" data-target="#collapsible-card-2">
	      <h5>Detail Order Anda</h5>
	    </span>
	  </div>


	  <div class="collapse show" id="collapsible-card-2">

	    <div class="card-body bg-secondary-lighter">
	      <div>
		    <div id="card" class="card">
			  @foreach($orders as $order)
			  @if($order['status_order'] == 'Menunggu Pembayaran')
			  <div class="card-header bg-dark text-white">
			   	<b>{{$order->kode_order}} - No Meja {{$order->no_meja}}</b>
			  </div>
			  <div class="card-body">
			    <ul class="list-group list-group-flush">
					@foreach($order->cart->items as $item)
				    <li class="list-group-item">
				    	<span class="badge badge-dark float-right">Rp.{{number_format($item['harga'],0,',','.')}},</span>
				    	{{$item['item']['nama_masakan']}}<span class="badge badge-warning float-right">{{$item['qty']}} Qty</span> 
				    </li>
					@endforeach
				 </ul>
			  </div>
			  <div class="card-footer">
			    <strong class="float-right" style="text-transform: uppercase; color: green;">Total : Rp.{{number_format($order->subtotal,0,',','.')}},</strong><span class="badge badge-dark">Diorder pada : {{date('d F Y - H:i', strtotime($order->created_at))}}</span> <span class="badge badge-secondary">Status	:
	            <?php 
			            if ($order['status_order']=='Pending') {
			                echo "<span class='badge badge-warning text-dark bounce'>Menunggu Diantar</span>";
			            } elseif($order['status_order']=='Menunggu Pembayaran') {
			            	echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
			            } elseif($order['status_order']=='Beres') {
			            	echo "<span class='badge badge-success'>ORDERAN BERES</span>";
			            } else {
			            	echo "<span class='badge badge-danger'>DIBATALKAN</span>";
			            }
			     		?></span>
			  </div>
			  @else
			  <h4>Tidak Ada Data Pesanan :(</h4>
			  @endif
			  @endforeach
			</div>
	      </div>

	    </div>
	  </div>
	</div>
</div>



@endsection