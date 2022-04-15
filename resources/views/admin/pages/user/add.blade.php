@extends('admin.main2')
@section('title','Tambah Data User')

@section('content')
	<div class="main-content">

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

		  <form method="POST" action="{{ route('admin.user.add') }}">
			@csrf
			<div class="card">
				<div class="card-header bg-primary pb-1">
		        	<h5 class="text-light"><span class="oi oi-plus"></span> Tambah Data User</h5>
		   		</div>
				<div class="card-body">
					<div class="form-group form-label-group">
						<label for="iFullname">Name</label>
						<input type="text" name="fullname"
						class="form-control {{ $errors->has('fullname')?'is-invalid':'' }} "
						value="{{ old('fullname') }}"
						id="iFullname" placeholder="Nama Lengkap" required>
						@if($errors->has('fullname'))
						<div class="invalid-feedback">{{ $errors->first('fullname') }}</div>
						@endif
						<small class="text-muted">
							Panjang Karakter 8-50, Contoh : Ryan Dinul Fatah
						</small>
					</div><!--End Form Group-->

					<div class="form-group form-label-group">
						<label for="iUsername">Username</label>
						<input type="text" name="username"
						class="form-control {{ $errors->has('username')?'is-invalid':'' }} "
						value="{{ old('username') }}"
						id="iUsername" placeholder="Username" required>
						@if($errors->has('username'))
						<div class="invalid-feedback">{{ $errors->first('username') }}</div>
						@endif
						<small class="text-muted">
							Panjang Karakter 4-50, Tidak Boleh Memakai spasi <br>Contoh : ryan, ryan_12, ryandf
						</small>
					</div><!--End Form Group-->

					<div class="form-group form-label-group">
						<label for="iEmail">Email</label>
						<input type="email" name="email"
						class="form-control {{ $errors->has('email')?'is-invalid':'' }} "
						value="{{ old('email') }}"
						id="iEmail" placeholder="Email" required>
						@if($errors->has('email'))
						<div class="invalid-feedback">{{$errors->first('email')}}</div>
						@endif
						<small class="text-muted">
							Isi Email anda dengan Email yang Valid. <br>
							Contoh : ryandf@gmail.com, ryan@student.edu
						</small>
					</div><!--End Form Group-->

					<div class="form-group form-label-group">
						<label for="iPassword">Password</label>
						<input type="password" name="password"
						class="form-control {{ $errors->has('password')?'is-invalid':'' }} "
						id="iPassword" placeholder="Password" required>
						@if($errors->has('password'))
						<div class="invalid-feedback">{{$errors->first('password')}}</div>
						@endif
					</div><!--End Form Group-->

					<div class="form-group form-label-group">
						<label for="iRePassword">Re Password</label>
						<input type="password" name="repassword"
						class="form-control {{ $errors->has('repassword')?'is-invalid':'' }} "
						id="iRePassword" placeholder="RePassword" required>
						@if($errors->has('repassword'))
						<div class="invalid-feedback">{{$errors->first('repassword')}}</div>
						@endif
					</div><!--End Form Group-->

					<div class="form-group form-label-group">
						<select name="level" class="form-control">
							<option value="">Pilih Level Sebagai :</option>
							<option value="admin">Admin</option>
							<option value="waiter">Waiter</option>
							<option value="kasir">Kasir</option>
							<option value="owner">Owner</option>
							<option value="pelanggan">Pelanggan</option>
						</select>
					</div><!--End Form Group-->

				</div><!--End Card body-->

				<div class="card-footer">
					<button class="btn btn-primary" type="submit">Simpan</button><!--End Card footer-->
				</div>

			</div><!--End Card-->
		</form>

		</div>

	</div>
@endsection