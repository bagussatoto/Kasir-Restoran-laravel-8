@extends('layouts.report')
@section('title','Your Delivery')
@section('content')

<div class="row contacts">
	    <div class="col invoice-to">
	        <div class="text-gray-light">INVOICE TO:</div>
	        <h2 class="to">{{Auth::user()->fullname}}</h2>
	    </div>
	    <div class="col invoice-details">
	    	@foreach($orders as $order)
	        <h1 class="invoice-id">{{$order->kode_order}}</h1>
	        <div class="date">Date of Invoice: {{date('d F Y - H:i',strtotime($order->created_at))}}</div>
	        @endforeach
	    </div>
	</div>

   	@foreach($orders as $order)
    <h2>NO MEJA	: {{$order->no_meja}}</h2>
    <hr>
    <h2>Kode Delivery	: {{$order->kode_order}}</h2>
    <hr>
    <h2>Menunggu Pembayaran</h2>
    @endforeach
    <br>
	
	
	<div class="notices">
	    <div>NOTICE:</div>
	    <div class="notice">Silahkan Menuju Kasir dengan Membawa Kertas Ini.</div>
	</div>

@endsection