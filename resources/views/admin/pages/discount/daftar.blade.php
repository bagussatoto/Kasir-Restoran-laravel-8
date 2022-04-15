@extends('admin.main2')
@section('title','Manage Discounts')
@section('content')

<div class="row pl-3 pt-2 mb-5">
    <div class="col-lg-8 pl-3">
		<h1>Manage Voucher Discounts</h1>
	    <div class="row">
			<div class="col-md-6 mb-3">
				<a href="" data-toggle="modal" data-target="#tambahDiscount" class="btn btn-primary"><span class="oi oi-plus"> Buat Baru</span></a>
			</div>
		</div>
		
		<div class="table-responsive-md">
			<table id="datatabled" class="table">
	            <thead class="border-0">
	                <tr>
				      <th scope="col">#</th>
				      <th scope="col">Kode Voucher</th>
				      <th scope="col">Percent Off</th>
				      <th scope="col">Aksi</th>
				    </tr>
	            </thead>
	            <tbody>
	              @foreach($discount as $dt)
	              <tr>
	                  <th scope="row">{{$loop->iteration}}</th>
				      <td>{{$dt->kode_discount}}</td>
				      <td>{{$dt->percent_off}}%</td>

				      <td>
				          <a href="{{route('getEdit',['id' =>$dt->id])}}" class="btn btn-success btn-sm">
				          	<span class="oi oi-pencil"></span>
				          </a>

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
					<form id="form-delete" action="{{ route('daftar.discounts') }}" method="post" >
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

<div class="modal fade" id="tambahDiscount" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<h3 class="modal-title text-white">Tambah Discount</h3>
				<button class="close" type="button" data-dismiss="modal">
					<span class="text-white">x</span>
				</button>
			</div>
			
			<div class="modal-body">
				<form method="POST" action="{{ route('saveDiscount') }}">
					@csrf
					<div class="form-group form-label-group">
						<label for="iDiscountPercent">Percent of Discount</label>
						<input type="number" min="1" max="100" name="percent_off"
						class="form-control {{ $errors->has('percent_off')?'is-invalid':'' }} "
						value="{{ old('percent_off') }}"
						id="iDiscountPercent" placeholder="Percent of Discount" required>
						@if($errors->has('percent_off'))
						<div class="invalid-feedback">{{ $errors->first('percent_off') }}</div>
						@endif
						<small class="text-muted">
							jumlah persen dari discount.
						</small>
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

<script>
	$(function () {
		$('.btn-trash').click(function () {
			id = $(this).attr('data-id');
			$('#input-id').val(id);
			$('#deleteModal').modal('show');
		});

		$('.btn-delete').click(function () {
			$('#form-delete').submit();
		});
	})
</script>

@endpush