@extends('layouts.report')
@section('title','Your Invoice')
<!-- <div class="toolbar hidden-print">
    <div class="text-right">
        <button id="printInvoice" class="btn btn-info"><i class="oi oi-print"></i> Print</button>
    </div>
    <hr>
</div> -->
@section('content')

<div class="row contacts">
	    <div class="col invoice-to">
	        <div class="text-gray-light">RECEIPT TO:</div>
	        @foreach($data as $dt)
	        <h2 class="to">{{$dt->fullname}}</h2>
	        @endforeach
	    </div>
	    <div class="col invoice-details">
	    	@foreach($data as $dt)
	        <h1 class="invoice-id">{{$dt->kode_transaksi}}</h1>
	        <div class="date">Date of Invoice: {{date('d F Y - H:i',strtotime($dt->created_at))}}</div>
	        @endforeach
	    </div>
	</div>
	<table border="0" cellspacing="0" cellpadding="0">
	    <thead>
	        <tr>
	            <th><b>KODE DELIVERY</b></th>
	            <th><b>NOMOR MEJA</b></th>
	            <th><b>DIPESAN PADA</b></th>
	            <th class="text-left"><b>DETAIL PESANAN</b></th>
	            <th class="text-right"><b>TOTAL</b></th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach($orders as $order)
	        <tr>
	            <td>{{$order->kode_order}}</td>
	            <td>{{$order->no_meja}}</td>
	            <td>{{date('d F Y - H:i',strtotime($order->created_at))}}</td>
	            <td class="text-left"> 
	                <table class="table shadow-0">
	                	<thead class="border-0">
				            <tr>
				              <th scope="col">#</th>
				              <th scope="col">Item</th>
				              <th scope="col">Harga Satuan</th>
				              <th scope="col">Qty</th>
				              <th scope="col">Subtotal</th>
				            </tr>
				          </thead>
	                      <tbody>
	                        @foreach($order->cart->items as $item)
	                        <tr>
	                          <th scope="row">{{$loop->iteration}}</th>
	                          <td>{{$item['item']['nama_masakan']}}</td>
	                          <td>Rp.{{number_format($item['item']['harga']),0,',','.'}}</td>
	                          <td>{{$item['qty']}}</td>
	                          <td>Rp.{{number_format($item['harga']),0,',','.'}}</td>
	                        </tr>
	                        @endforeach
	                      </tbody>
	                  </table>
	            </td>
	            <td class="text-right"><strong>Rp.{{number_format($order->subtotal),0,',','.'}}</strong></td>
	        </tr>
	        @endforeach
	    </tbody>
	    <tfoot>
	    	<!-- <tr>
	            <td colspan="2"></td>
	            <td colspan="2">PPN 10%</td>
	            <td><strong class="text-warning-darker">Rp.{{number_format(7000),0,',','.'}}</strong></td>
	        </tr> -->
	        <tr>
	            <td colspan="2"></td>
	            <td colspan="2">Total Tagihan</td>
	            @foreach($orders as $order)
	            <td><strong class="text-danger">Rp.{{number_format($order->subtotal),0,',','.'}}</strong></td>
	            @endforeach
	        </tr>
	        <tr>
	            <td colspan="2"></td>
	            <td colspan="2">Uang Masuk</td>
	            @foreach($data as $dt)
	            <td><strong class="text-success-darker">Rp.{{number_format($dt->total_bayar),0,',','.'}}</strong></td>
	            @endforeach
	        </tr>
	        <tr>
	            <td colspan="2"></td>
	            <td colspan="2">Kembalian</td>
	            @foreach($data as $dt)
	            <td>Rp.{{number_format($dt->kembalian),0,',','.'}}</td>
	            @endforeach
	        </tr>
	    </tfoot>
	</table>
	<div class="thanks">Thank you!</div>
	<div class="notices">
	    <div>NOTICE:</div>
	    <div class="notice">Jika ada keluhan mengenai aplikasi silahkan, hubungi petugas.</div>
	</div>

@endsection
@push('js')
<script type="text/javascript">
 window.onload = function () {
 	window.print();
 }
</script>
@endpush