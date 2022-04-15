@extends('admin.main2')
@section('title','Edit Data Kategori')

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

	<div class="row">
		<div class="col-md-6 mx-auto">
			<form method="POST" action="{{ route('admin.masakan.kategori.edit', ['id'=>$rc->id]) }}">
				@csrf
				<div class="card">
					<div class="card-header bg-primary pb-1">
			        	<h5 class="text-center text-white"><span  class="oi oi-pencil"></span> Edit Data Kategori</h5>
			   		</div>
					<div class="card-body">
						<div class="form-group form-label-group">
							<label for="iKategori">Kategori</label>
							<input type="text" name="nama_kategori"
							class="form-control {{ $errors->has('nama_kategori')?'is-invalid':'' }} "
							value="{{ old('nama_kategori',$rc->nama_kategori) }}"
							id="iNamaKategori" required autofocus>
							@if($errors->has('nama_kategori'))
							<div class="invalid-feedback">{{ $errors->first('nama_kategori') }}</div>
							@endif
						</div><!--End Form Group-->

					<div class="card-footer">
						<button class="btn btn-primary" type="submit">Update</button><!--End Card footer-->
					</div>

				</div><!--End Card-->
			</form>
		</div>
	</div>

  
</div>
@endsection

