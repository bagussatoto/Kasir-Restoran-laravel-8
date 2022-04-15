@extends('admin.main2')
@section('title','Daftar Masakan')
@section('content')

		<!-- @if(session('result') == 'delete')
		<div class="alert alert-success data-dismissible" role="alert">
		  <h4 class="alert-heading">Terhapus!</h4>Data Berhasil Dihapus dari Database.
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		</div>
		@endif -->
		
		

	<div class="row pl-3 pt-2 mb-5">
	    <div class="col-lg-12 pl-3">
	    	<h1>Data Semua Masakan</h1>

			<div class="row">
				<div class="col-md-6 mb-3">
					<a href="" data-toggle="modal" data-target="#tambahMasakan" class="btn btn-primary"><span class="oi oi-plus"></span> Buat Baru</a>
				</div>

				<!-- <div class="col-md-6 mb-3">
					<form method="GET" action="{{ route('admin.masakan') }}">
						@csrf
						<div class="input-group">
							<input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Cari Sesuatu...">
							<span class="input-group-btn"><button type="button" class="btn btn-primary">Cari</button></span>
						</div>
					</form>
				</div> -->
			</div>    	
			<div class="table-responsive-md">
		        <table id="datatabled" class="table">
		            <thead class="border-0">
		                <tr>
					      <th scope="col">#</th>
					      <th scope="col">Gambar</th>
					      <th scope="col">Item</th>
					      <th scope="col">Aksi</th>
					    </tr>
		            </thead>
		            <tbody>
		              @foreach($data as $dt)
		              <tr>
		                  <th scope="row">{{$loop->iteration}}</th>
					      <td><a href="{{url('storage/gambar/'.$dt->gambar)}}"><img class="img-fluid" src="{{url('storage/gambar/'.$dt->gambar)}}" width="75px"></a></td>
					      <td>
					      	<small class="text-muted">{{$dt->kode_masakan}}</small><br>
							<strong>{{$dt->nama_masakan}}</strong>,
							Harga Rp.{{number_format($dt->harga,0,',','.')}}, 
							Stok <?php 
				            if ($dt['status_masakan']=='Ada') {
				                echo "<span class='badge badge-success'>Ada</span>";
				            } else {
				                echo "<span class='badge badge-danger'>Habis</span>";
				            }
				     		?>
							<br>
							<small class="text-muted">{{$dt->nama_kategori}}</small>
					      </td>

					      <td>
					          <!-- kolom edit -->
							<a href="{{ route('admin.masakan.edit', ['id'=>$dt->id]) }}" class="btn btn-success btn-sm">
					          	<span class="oi oi-pencil"></span>
					         </a>

							<!-- kolom hapus -->
					          <button class="btn btn-danger btn-sm btn-trash"
					          id="tombol-hapus" 
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

	@endsection


<!-- START MODAL HAPUS -->
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
					<form id="form-delete" action="{{ route('admin.masakan') }}" method="post" >
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

	<div class="modal fade" id="tambahMasakan" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<h3 class="modal-title text-white">Tambah Data Masakan</h3>
					<button class="close" type="button" data-dismiss="modal">
						<span class="text-white">x</span>
					</button>
				</div>
				
				<div class="modal-body">
					<form method="POST" action="{{ route('admin.masakan.add') }}" enctype="multipart/form-data">
						@csrf
						<div class="form-group form-label-group">
							<label for="iNamaMasakan">Nama Masakan</label>
							<input type="text" name="nama_masakan"
							class="form-control {{ $errors->has('nama_masakan')?'is-invalid':'' }} "
							value="{{ old('nama_masakan') }}"
							id="iNamaMasakan" placeholder="Nama Masakan" required>
							@if($errors->has('nama_masakan'))
							<div class="invalid-feedback">{{ $errors->first('nama_masakan') }}</div>
							@endif
						</div><!--End Form Group-->

						<div class="form-group form-label-group">
							<label for="iKategori">Kategori</label>
							<select name="kategori_id" class="form-control {{ $errors->has('kategori_id')?'is-invalid':'' }}" required autofocus>
								<option value="">Kategori :</option>
								<?php 
									$val = Request::old('kategori_id');
									$res = App\Kategori::orderBy('nama_kategori','asc')->get();
								 ?>

								 @foreach($res as $opt)
								<option value="{{$opt->id}}" {{$val==$opt->id?'selected':''}}>{{$opt->nama_kategori}}</option>
								@endforeach
							</select>
						</div><!--End Form Group-->

						<div class="form-group form-label-group">
							<label for="iGambar">Gambar</label>
							<input type="file" name="gambar"
							class="form-control {{ $errors->has('gambar')?'is-invalid':'' }} "
							accept="image/*" 
							value="{{ old('gambar') }}"
							id="iGambar" placeholder="Gambar Masakan" required>
							@if($errors->has('gambar'))
							<div class="invalid-feedback">{{ $errors->first('gambar') }}</div>
							@endif
						</div><!--End Form Group-->

						<div class="form-group form-label-group">
							<label for="iHarga">Harga</label>
							<input type="number" name="harga"
							class="form-control {{ $errors->has('harga')?'is-invalid':'' }} "
							value="{{ old('harga') }}"
							id="iHarga" placeholder="Harga Masakan" required>
							@if($errors->has('harga'))
							<div class="invalid-feedback">{{ $errors->first('harga') }}</div>
							@endif
						</div><!--End Form Group-->

						<div class="form-group form-label-group">
							<label for="">Status Masakan</label>
							<select name="status_masakan" class="form-control">
								<option value="">Status Masakan :</option>
								<option value="Ada">Ada</option>
								<option value="Habis">Habis</option>
							</select>
						</div><!--End Form Group-->
						
					</div>

				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button class="btn btn-primary" type="submit">Simpan</button>
				</div>
				</form>

			</div>
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

<script type="text/javascript">
	function filePreview(input) {
		if(input.files && input.files[0]) {}
			var reader = new FileReader();
			reader.onload = function(e){
				$('#iGambar + img').remove();
				$('#iGambar').after('<img src="'+e.target.result+'" width="100" class="mt-3" />');
			}
			reader.readAsDataURL(input.files[0]);
	}
	$(function() {
		$('#iGambar').change(function(){
			filePreview(this);
		})
	})
</script>

@endpush
<!-- END MODAL HAPUS -->
