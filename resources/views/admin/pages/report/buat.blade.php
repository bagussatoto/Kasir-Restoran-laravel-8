@extends('admin.main2')
@section('title','Buat Laporan')
@section('content')

<div class="col-lg-12 mx-auto"> 

	<h5>Laporan Semua Transaksi</h5>
    <table id="datatabled" class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pemesan</th>
            <th scope="col">Kode Delivery</th>
            <th scope="col">Kode Transaksi</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data as $dt)
          <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$dt->fullname}}</td>
            <td>{{$dt->kode_order}}</td>
            <td>{{$dt->kode_transaksi}}</td>
            <td>Rp.{{number_format($dt->subtotal,0,',','.')}},</td>
          </tr>
          @endforeach
        </tbody>
	</table>

	<h1>Jumlah Pendapatan : Rp.{{number_format($pendapatan,0,',','.')}},</h1>

</div>

@endsection