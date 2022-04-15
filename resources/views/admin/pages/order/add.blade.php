@extends('admin.main2')
@section('title','Tambah Data Pesanan')

@section('content')
<div class="container-fluid">

	@if(session('result') == 'success')
	<div class="alert alert-success data-dismissible" role="alert">
	  <h4 class="alert-heading">Berhasil!</h4>Data Berhasil Disimpan ke Database.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	
	@elseif(session('result') == 'fail')
	<div class="alert alert-danger data-dismissible" role="alert">
	  <h4 class="alert-heading">Ups!</h4>Ada Kesalahan, Check Kembali Data Dibawah.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif

  <form method="POST" action="{{ route('admin.order.add') }}">
	@csrf
	<div class="card">
		<div class="card-header bg-primary pb-1">
        	<h5 class="text-light"><span class="oi oi-plus"></span> Tambah Data Order</h5>
   		</div>
		<div class="card-body">
			<div class="form-group form-label-group">
				<label for="iNomorMeja">Nomor Meja</label>
				<input type="text" name="no_meja"
				class="form-control {{ $errors->has('no_meja')?'is-invalid':'' }} "
				value="{{ old('no_meja') }}"
				id="iNomorMeja" placeholder="Nomor Meja" required>
				@if($errors->has('no_meja'))
				<div class="invalid-feedback">{{ $errors->first('no_meja') }}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iPemesan">Pemesan</label>
				<select name="id_user" class="form-control {{ $errors->has('id_user')?'is-invalid':'' }}" required autofocus>
					<option value="">Pemesan :</option>
					<?php 
						$val = Request::old('id_user');
						$res = App\User::orderBy('fullname','asc')->get();
					 ?>

					 @foreach($res as $opt)
					<option value="{{$opt->id}}" {{$val==$opt->id?'selected':''}}>{{$opt->fullname}}</option>
					@endforeach
				</select>
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iKeterangan">Keterangan</label>
				<input type="text" name="keterangan"
				class="form-control {{ $errors->has('keterangan')?'is-invalid':'' }} "
				id="iKeterangan" placeholder="Keterangan" required>
				@if($errors->has('keterangan'))
				<div class="invalid-feedback">{{$errors->first('keterangan')}}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="">Status Order</label>
				<select name="status_order" class="form-control">
					<option value="">Status Order :</option>
					<option value="Pending">Pending</option>
					<option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
					<option value="Beres">Beres</option>
					<option value="Dibatalkan">Dibatalkan</option>
				</select>
			</div><!--End Form Group-->

		</div><!--End Card body-->

		<div class="card-footer">
			<button class="btn btn-primary" type="submit">Simpan</button><!--End Card footer-->
		</div>

	</div><!--End Card-->
</form>
</div>
@endsection