@extends('layouts.main2')
@section('title','Checkout')
@section('content')

<div class="container">

	<div class="row">
		<div class="col-md-6 pt-4 mx-auto">
			<form method="POST" action="{{route('postcheckout')}}">
				@csrf
				<div class="card">
					<div class="card-header bg-success-darker pb-1">
			        	<h5 class="text-light"><span  class="oi oi-cart"></span> Verifikasi Nomor Meja</h5>
			   		</div>
			   		@if(session('info') == 1)
			   		<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>Meja Sedang Digunakan</strong> Saat ini, Nomor Meja yang anda pilih sedang dipakai,silahkan cek nomor meja anda sendiri.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
			   		@endif
					<div class="card-body">
						<div class="form-group form-label-group">
							<label for="">Nomor Meja Anda</label>
							<input type="number" min="1" max="50" name="no_meja"
							class="form-control {{ $errors->has('no_meja')?'is-invalid':'' }} "
							value="{{ old('no_meja') }}"
							id="" placeholder="Masukan Nomor Meja Anda..." required autofocus>
							@if($errors->has('no_meja'))
							<div class="invalid-feedback">{{ $errors->first('no_meja') }}</div>
							@endif
							<small class="text-muted">Masukan Nomor Meja yang tertera di Meja Anda.</small>
						</div><!--End Form Group-->

						<div class="form-group form-label-group">
							<label for="">Keterangan</label>
							<textarea  name="keterangan"
							class="form-control {{ $errors->has('keterangan')?'is-invalid':'' }} "
							value="{{ old('keterangan') }}"
							id="" placeholder="Ketikan sesuatu..."></textarea>
							@if($errors->has('keterangan'))
							<div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
							@endif
							<small class="text-muted">ex**: Rendangnya Jangan Terlalu Pedas, Es nya jangan terlalu banyak.</small>
							<small class="text-muted">| Lewati bila tidak ingin menambah keterangan.</small>
						</div><!--End Form Group-->
						<small class="text-muted"></small>

						<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
						<input type="hidden" value="Menunggu Pembayaran" name="status_order">
					</div>	

					<div class="card-footer">
						<button class="btn btn-success" type="submit"><span class="oi oi-check"></span> Simpan</button><!--End Card footer-->
					</div>

				</div><!--End Card-->
			</form>
		</div>
	</div>
</div>

@endsection