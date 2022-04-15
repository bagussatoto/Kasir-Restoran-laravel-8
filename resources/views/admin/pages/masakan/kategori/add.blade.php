@extends('admin.main2')
@section('title','Tambah Data Kategori')

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

	<div class="row">
		<div class="col-md-6">
			<form method="POST" action="{{route('add.kategori')}}">
				@csrf
				<div class="card">
					<div class="card-header bg-primary pb-1">
			        	<h5 class="text-light"><span  class="oi oi-plus"></span> Tambah Data Kategori</h5>
			   		</div>
					<div class="card-body">
						<div class="form-group form-label-group">
							<label for="iKategori">Kategori</label>
							<input type="text" name="kategori"
							class="form-control {{ $errors->has('kategori')?'is-invalid':'' }} "
							value="{{ old('kategori') }}"
							id="iKategori" placeholder="Nama Kategori" required autofocus>
							@if($errors->has('kategori'))
							<div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
							@endif
						</div><!--End Form Group-->
					</div>	

					<div class="card-footer">
						<button class="btn btn-primary" type="submit">Simpan</button><!--End Card footer-->
					</div>

				</div><!--End Card-->
			</form>
		</div>
	</div>

  
</div>
@endsection