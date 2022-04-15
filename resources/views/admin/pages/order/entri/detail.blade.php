@extends('admin.main2')
@section('title','Detail Pemesanan')

@section('content')
<div class="container-fluid">

	@if(session('result') == 'success')
	<div class="alert alert-success data-dismissible" role="alert">
	  <h4 class="alert-heading">Terupdate!</h4>Data Berhasil Diupdate.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	
	@elseif(session('result') == 'fail')
	<div class="alert alert-danger data-dismissible" role="alert">
	  <h4 class="alert-heading">Ups!</h4>Ada Kesalahan Saat Menginputkan Data, Silahkan Check Kembali.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif

  <form method="POST" action="{{ route('admin.order.edit', ['id_order'=>$rc->id_order]) }}">
	@csrf
	<div class="card">
		<div class="card-header bg-primary pb-1">
        	<h5 class="text-light"><span class="oi oi-pencil"></span>Detail Pemesanan</h5>
   		</div>
		<div class="card-body">
			<div class="form-group form-label-group">
				<label for="iNomorMeja">Nomor Meja</label>
				<input type="number" name="no_meja"
				class="form-control {{ $errors->has('no_meja')?'is-invalid':'' }} "
				value="{{ old('no_meja',$rc->no_meja) }}"
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
						$val = old('id_user',$rc->id_user);
						$res = App\User::orderBy('fullname','asc')->get();
					 ?>

					@foreach($res as $opt)
					<option value="{{$opt->id}}" {{ $val==$opt->id?'selected':'' }}>{{$opt->fullname}}</option>
					@endforeach
				</select>
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iKeterangan">Keterangan</label>
				<input type="text" name="keterangan"
				class="form-control {{ $errors->has('keterangan')?'is-invalid':'' }} "
				value="{{ old('keterangan',$rc->keterangan) }}"
				id="iKeterangan" placeholder="Keterangan">
				@if($errors->has('keterangan'))
				<div class="invalid-feedback">{{$errors->first('keterangan')}}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<?php 
					$val = old('status_order',$rc->status_order);
				 ?>
				 <label for="">Status Order</label>
				<select name="status_order" class="form-control {{ $errors->has('status_order')?'is-invalid':'' }}" required>
					<option value="" disabled="" {{ $val==""?'selected':'' }}>Pilih Status Order:</option>
					<option value="Menunggu Pembayaran" {{ $val=="Menunggu Pembayaran"?'selected':'' }}>Menunggu Pembayaran</option>
					<option value="Pending" {{ $val=="Pending"?'selected':'' }}>Pending</option>
					<option value="Beres" {{ $val=="Beres"?'selected':'' }}>Beres</option>
					<option value="Dibatalkan" {{ $val=="DIbatalkan"?'selected':'' }}>Dibatalkan</option>
				</select>
				@if($errors->has('status_order'))
				<div class="invalid-feedback">{{$errors->first('status_order')}}</div>
				@endif
			</div><!--End Form Group-->

		</div><!--End Card body-->

		<div class="card-footer">
			<button class="btn btn-primary" type="submit">Update</button><!--End Card footer-->
		</div>

	</div><!--End Card-->
</form>
</div>
@endsection