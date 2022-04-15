@extends('admin.main2')
@section('title','User')

@Section('content')

	
	@if(session('result') == 'delete')
	<div class="alert alert-success data-dismissible" role="alert">
	  <h4 class="alert-heading">Terhapus!</h4>Data Berhasil Dihapus dari Database.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif

	

<div class="row pl-3 pt-2 mb-5">
    <div class="col-lg-12 pl-3">
		<h1>Data Semua User</h1>
	    <div class="row">
			<div class="col-md-6 mb-3">
				<a href="" data-toggle="modal" data-target="#tambahUser" class="btn btn-primary"><span class="oi oi-plus"> Buat Baru</span></a>
				<a class="btn btn-success" href="{{route('user.export.excel')}}"><span class="oi oi-print"></span> Export Excel</a>
			</div>

			<!-- <div class="col-md-6 mb-3">
				<form method="GET" action="{{ route('admin.user') }}">
					@csrf
					<div class="input-group">
						<input type="text" name="keyword" value="{{ request('keyword') }}" class="border-light bg-light-lighter form-control d-none d-md-block w-50 ml-3 mr-2" placeholder="Cari Sesuatu..." id="keyword" autofocus>
						<span class="input-group-btn"><button type="button" name="cari" class="btn btn-primary">Cari</button></span>
					</div>
				</form>
			</div> -->
		</div>

		<div class="table-responsive-md">
			<table id="datatabled" class="table">
	            <thead class="border-0">
	                <tr>
				      <th scope="col">#</th>
				      <th scope="col">Nama</th>
				      <th scope="col">Username</th>
				      <th scope="col">Email</th>
				      <th scope="col">Hak Akses</th>
				      <th scope="col">Aksi</th>
				    </tr>
	            </thead>
	            <tbody>
	              @foreach($data as $dt)
	              <tr>
	                  <th scope="row">{{$loop->iteration}}</th>
				      <td>{{$dt->fullname}}</td>
				      <td>{{$dt->username}}</td>
				      <td>{{$dt->email}}</td>
				      <td>{{$dt->level}}</td>

				      <td>
				          <a href="{{ route('admin.user.edit', ['id'=>$dt->id]) }}" class="btn btn-success btn-sm">
				          	<span class="oi oi-pencil"></span>
				          </a>

				          @if($dt->id != Auth::id() )
				          <button class="btn btn-danger btn-sm btn-trash"
				          id="tombol-hapus" 
				          data-id="{{ $dt->id }}"
				          type="button">
				          	<span class="oi oi-trash"></span>
				          </button>
				          @endif
				      </td>
	              </tr>
	              @endforeach
	            </tbody>
	    	</table>
		</div>
        

      </div>  
</div>

</div>

@endsection

@push('modal')

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger">
				<h3 class="modal-title text-white">Hapus Data Ini?</h3>
				<button class="close" type="button" data-dismiss="modal">
					<span class="text-white">x</span>
				</button>
			</div>
			
			<div class="modal-body">
				Data Tidak Bisa Dikembalikan setelah Terhapus,Anda Yakin?
				<form id="form-delete" action="{{ route('admin.user') }}" method="post" >
					@method('delete')
					@csrf
					<input type="hidden" name="id" id="input-id">
				</form>
			</div>

			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button class="btn btn-danger btn-delete" type="button">Hapus</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="tambahUser" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3 class="modal-title text-white">Tambah Data User</h3>
				<button class="close" type="button" data-dismiss="modal">
					<span class="text-white">x</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form method="POST" action="{{ route('admin.user.add') }}">
					@csrf
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
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
				<button class="btn btn-primary" type="submit">Simpan</button><!--End Card footer-->
			</div>
			</form>

		</div>
	</div>
</div>

@endpush

@push('js')

<script type="text/javascript">
	$(function() {
		$('.btn-trash').click(function() {
			id = $(this).attr('data-id');
			$('#input-id').val(id);
			$('#deleteModal').modal('show');
		});

		$('.btn-delete').click(function() {
			$('#form-delete').submit();
		});

	})
</script>
@endpush

