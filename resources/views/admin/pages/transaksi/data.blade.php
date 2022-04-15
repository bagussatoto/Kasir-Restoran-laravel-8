@extends('admin.main2')
@section('title','Data Transaksi')

@section('content')


	<!-- <div class="row">
		<div class="col-md-6 mb-3">
			<a href="#" class="btn btn-primary">[+] Tambah</a>
		</div>

		<div class="col-md-6 mb-3">
			<form method="GET" action="#">
				@csrf
				<div class="input-group">
					<input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Cari Sesuatu..." id="keyword" autofocus>
					<span class="input-group-btn"><button type="button" name="cari" class="btn btn-primary">Cari</button></span>
				</div>
			</form>
		</div>
	</div> -->


<div class="row pl-3 pt-2 mb-5">
    <div class="col-lg-11 pl-5">
    	<h1>Data Transaksi Masuk</h1>

		<div class="table-responsive-md">
			<table id="datatabled" class="table">
	            <thead class="border-0">
	              <tr>
	                  <th scope="col">#</th>
				      <th scope="col">Pemesan</th>
				      <th scope="col">Kode Order</th>
				      <th scope="col">Kode Transaksi</th>
				      <th scope="col">Tanggal</th>
				      <th scope="col">Total Bayar</th>
				      <th scope="col">Aksi</th>
	              </tr>
	            </thead>
	            <tbody>
	              @foreach($data as $dt)
	              <tr>
	                  <th scope="row">{{$loop->iteration}}</th>
				      <td>{{$dt->fullname}}</td>
				      <td>{{$dt->kode_order}}</td>
				      <td>{{$dt->kode_transaksi}}</td>
				      <td>{{date('d F Y - H:i', strtotime($dt->created_at))}}</td>
				      <td>Rp.{{number_format($dt->total_bayar,0,',','.')}},</td>
				      <td>
				          <a href="{{route('invoice', ['kode_order' => $dt->kode_order])}}" class="btn btn-success btn-sm" target="_blank">
				          	<span class="oi oi-print"></span>
				          </a>

				          <button class="btn btn-danger btn-sm btn-trash"
				          data-id="{{$dt->id}}"
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
					<form id="form-delete" action="{{ route('admin.transaksi') }}" method="post" >
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