@extends('admin.main2')
@section('title','Edit Data User')

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

  <form method="POST" action="{{ route('admin.user.edit', ['id'=>$rc->id]) }}">
	@csrf
	<div class="card">
		<div class="card-header bg-primary pb-1">
        	<h5 class="text-light"><span class="oi oi-pencil"></span> Edit Data User</h5>
   		</div>
		<div class="card-body">
			<div class="form-group form-label-group">
				<label for="iFullname">Nama Lengkap</label>
				<input type="text" name="fullname"
				class="form-control {{ $errors->has('fullname')?'is-invalid':'' }} "
				value="{{ old('fullname',$rc->fullname) }}"
				id="iFullname" placeholder="Nama Lengkap" required>
				@if($errors->has('fullname'))
				<div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iUsername">Username</label>
				<input type="text" name="username"
				class="form-control {{ $errors->has('username')?'is-invalid':'' }} "
				value="{{ old('username',$rc->username) }}"
				id="iUsername" placeholder="Username" required>
				@if($errors->has('username'))
				<div class="invalid-feedback">{{ $errors->first('username') }}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iEmail">Email</label>
				<input type="email" name="email"
				class="form-control {{ $errors->has('email')?'is-invalid':'' }} "
				value="{{ old('email',$rc->email) }}"
				id="iEmail" placeholder="Email" required>
				@if($errors->has('email'))
				<div class="invalid-feedback">{{$errors->first('email')}}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iPassword">Password</label>
				<input type="password" name="password"
				class="form-control {{ $errors->has('password')?'is-invalid':'' }} "
				id="iPassword" placeholder="Password">
				<div class="form-text text-muted">
					<small>Kosongkan Bila Password Tidak Diubah.</small>
				</div>
				@if($errors->has('password'))
				<div class="invalid-feedback">{{$errors->first('password')}}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<label for="iRePassword">Re Password</label>
				<input type="password" name="repassword"
				class="form-control {{ $errors->has('repassword')?'is-invalid':'' }} "
				id="iRePassword" placeholder="RePassword">
				@if($errors->has('repassword'))
				<div class="invalid-feedback">{{$errors->first('repassword')}}</div>
				@endif
			</div><!--End Form Group-->

			<div class="form-group form-label-group">
				<?php 
					$val = old('level',$rc->level);
				 ?>
				<select name="level" class="form-control {{ $errors->has('level')?'is-invalid':'' }}" required>
					<option value="" disabled="" {{ $val==""?'selected':'' }}>Pilih Level Sebagai :</option>
					<option value="admin" {{ $val=="admin"?'selected':'' }}>Admin</option>
					<option value="waiter" {{ $val=="waiter"?'selected':'' }}>Waiter</option>
					<option value="kasir" {{ $val=="kasir"?'selected':'' }}>Kasir</option>
					<option value="owner" {{ $val=="owner"?'selected':'' }}>Owner</option>
					<option value="pelanggan" {{ $val=="pelanggan"?'selected':'' }}>Pelanggan</option>
				</select>
				@if($errors->has('level'))
				<div class="invalid-feedback">{{$errors->first('level')}}</div>
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