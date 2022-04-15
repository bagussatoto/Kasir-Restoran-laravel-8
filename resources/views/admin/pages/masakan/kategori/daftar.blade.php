@extends('admin.main2')
@section('title','Daftar Kategori')
@section('content')

<div class="container-fluid">
	
	@if(session('result') == 'delete')
	<div class="alert alert-success data-dismissible" role="alert">
	  <h4 class="alert-heading">Terhapus!</h4>Data Berhasil Dihapus dari Database.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif

	@if(session('result') == 'fail')
	<div class="alert alert-danger data-dismissible" role="alert">
	  <h4 class="alert-heading">Ups!</h4>Ada Kesalahan, Check Kembali Data Dibawah.
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	@endif


	<div class="row pl-3 pt-2 mb-7">
	    <div class="col-lg-7 pl-3">
	    	<h1>Data Semua Kategori</h1>

			<div class="row">
				<div class="col-md-6 mb-3">
					<a href="" data-toggle="modal" data-target="#tambahKategori" class="btn btn-primary"><span class="oi oi-plus"></span> Buat Baru</a>
				</div>

				<!-- <div class="col-md-6 mb-3">
					<form method="GET" action="{{ route('admin.masakan.kategori') }}">
						@csrf
						<div class="input-group">
							<input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Cari Sesuatu..." id="keyword" autofocus>
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
				      	  <th scope="col">Kategori</th>
				      	  <th scope="col">Aksi</th>
					    </tr>
		            </thead>
		            <tbody>
		              @foreach($data as $dt)
		              <tr>
		                  <th scope="row">{{$loop->iteration}}</th>
					      <td>{{$dt->nama_kategori}}</td>

					      <td>
					          <a href="{{route('admin.masakan.kategori.edit', ['id'=>$dt->id])}}" class="btn btn-success btn-sm">
					          	<span class="oi oi-pencil"></span>
					          </a>

					          <button class="btn btn-danger btn-sm btn-trash"
					          data-id="{{ $dt->id }}"
					          type="button">
					          	<span class="oi oi-trash"></span>
					          </button>
					      </td>
		              </tr>
		              @endforeach
		            </tbody>
		    	</table>
			</div>
		        
	      </div>  
	</div>

	{{

		$data->appends(request()->only('keyword'))
		->links('vendor.pagination.bootstrap-4')
	}}

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
				<form id="form-delete" action="{{ route('admin.masakan.kategori') }}" method="post" >
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

<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3 class="modal-title text-white">Tambah Data Kategori</h3>
				<button class="close" type="button" data-dismiss="modal">
					<span class="text-white">x</span>
				</button>		
			</div>
			
			<div class="modal-body">
				<form action="{{route('add.kategori')}}" method="POST">
					@csrf
					<div class="form-group form-label-group">
						<label for="iKategori">Kategori</label>
						<input type="text" name="kategori"
						class="form-control {{ $errors->has('kategori')?'is-invalid':'' }} "
						value="{{ old('kategori') }}"
						id="iKategori" placeholder="Nama Kategori" required autofocus>
						@if($errors->has('kategori'))
						<div class="invalid-feedback">{{ $errors->first('kategori') }}</div>
						@endif		
					</div>
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Tutup</button>
				<button class="btn btn-primary" type="submit">Simpan</button>
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