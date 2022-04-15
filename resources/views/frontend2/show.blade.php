@extends('layouts.app')
@section('content')

<div class="container">


	<div class="row">

		<div class="col-md-5">
			<div class="card">
			  <div class="card-body">
			    <img src="{{url('storage/gambar/'.$data->gambar)}}" width="400">
			  </div>
			</div>		
		</div>

		<div class="col-md-6">
			<div class="card-group">
				  <div class="card">
				    <div class="card-body">
				      <h2>{{$data->nama_masakan}}</h2>
						<hr>
						<h4 class="badge badge-danger">Rp.{{number_format($data->harga,0,',','.')}},</h4>
						<form>
						  <div class="form-group">
						    <input type="text" class="form-control" placeholder="Masukan Keterangan">
						    <small class="form-text text-muted">**ex:Pedesnya level 1 aja mba/mas.</small>
						  </div>
						  <div class="form-group">
						    <input type="number" class="form-control" placeholder="Jumlah Item">
						    <small class="form-text text-muted">**ex:Masukan Jumlah yang ingin anda pesan.</small>
						  </div>
						  <a href="{{route('add.cart', ['id' => $data->id])}}" class="btn btn-success btn-block"><i class="fa fa-cart-plus" aria-hidden="true"></i> Tambahkan ke Keranjang</a>
						</form>
				    </div>
				</div>
			</div>
		</div>

</div>

@endsection