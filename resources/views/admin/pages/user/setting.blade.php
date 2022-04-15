@extends('admin.main2')
@section('title','User Setting')
@section('content')

	@if(session('result') == 'success')
	<div class="alert alert-success data-dismissible" role="alert">
	  <h4 class="alert-heading">Terupdate!</h4>Data Berhasil Diupdate.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	
	@elseif(session('result') == 'fail')
	<div class="alert alert-danger data-dismissible" role="alert">
	  <h4 class="alert-heading">Ups!</h4>Ada Kesalahan Saat Menginputkan, Silahkan Di Check Kembali.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif

	<div class="row">
		<div class="col-md-6">
			<form method="POST" action="{{ route('admin.user.setting') }}">
				<div class="card mb-3">
					<div class="card-header bg-primary pb-1">
			        	<h5 class="text-light"><span class="oi oi-cog"></span> Edit Data User</h5>
			   		</div>
					<div class="card-body">
						@csrf
						<div class="form-group form-label-group">
							<label for="iFullname">Name</label>
							<input type="text" name="fullname" class="form-control {{ $errors->has('fullname')?'is-invalid':''}}"
							value="{{ old('fullname',$dt->fullname) }}"
							id="iFullname" placeholder="Nama Lengkap" required>
							@if($errors->has('fullname'))
							<div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
							@endif
						</div>

						<div class="form-group form-label-group">
							<label for="iUsername">Username</label>
							<input type="text" name="username" class="form-control {{ $errors->has('username')?'is-invalid':''}}"
							value="{{ old('username',$dt->username) }}"
							id="iUsername" placeholder="Username" required>
							@if($errors->has('username'))
							<div class="invalid-feedback">{{ $errors->first('username') }}</div>
							@endif
						</div>

						<div class="form-group form-label-group">
							<label for="iEmail">Email</label>
							<input type="text" name="email" class="form-control {{ $errors->has('email')?'is-invalid':''}}"
							value="{{ old('email',$dt->email) }}"
							id="iEmail" placeholder="Email" required>
							@if($errors->has('email'))
							<div class="invalid-feedback">{{ $errors->first('email') }}</div>
							@endif
						</div>

						<div class="form-group form-label-group">
							<label for="iPassword">Password</label>
							<input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}"
							id="iPassword" placeholder="Password">
							@if($errors->has('password'))
							<div class="invalid-feedback">{{ $errors->first('password') }}</div>
							@endif
							<div class="form-text text-muted">
								<small class="text-muted">Kosongkan Bila Password Tidak Diubah.</small>
							</div>
						</div>

						<div class="form-group form-label-group">
							<label for="iRePassword">Repassword</label>
							<input type="password" name="repassword" class="form-control {{ $errors->has('repassword')?'is-invalid':''}}"
							id="iRePassword" placeholder="RePassword">
							@if($errors->has('repassword'))
							<div class="invalid-feedback">{{ $errors->first('repassword') }}</div>
							@endif
						</div>

						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Simpan Perubahan</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

<!-- @push('modal')
<div class="modal fade" id="settingModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apakah Anda Mau Logout?</h5>
        


      </div>
    </div>
  </div>
</div>
@endpush -->


@endsection