@extends('admin.main2')
@section('title','Data Order')

@section('content')

<div class="row pl-3 pt-2 mb-5">
    <div class="col-lg-12 pl-3">
    	<h1>Data Semua Orderan Masuk</h1>

	    <!-- <div class="row">
			<div class="col-md-6 mb-3">
				<a href="{{route('admin.order.add')}}" class="btn btn-primary"><span class="oi oi-plus"></span> Buat Baru</a>
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
		</div>  -->  	
		<div class="table-responsive-md">
			<table id="datatabled" class="table">
	            <thead class="border-0">
	                <tr>
				      <th scope="col">#</th>
					  <th scope="col">Kode Delivery</th>      
				      <th scope="col">Nomor Meja</th>
				      <th scope="col">Tanggal Order</th>
				      <th scope="col">Pemesan</th>
				      <th scope="col">Keterangan</th>
				      <th scope="col">Status</th>
				      <th scope="col">Aksi</th>
				    </tr>
	            </thead>
	            <tbody>
	              @foreach($data as $dt)
	              <tr>
	                  <th scope="row">{{$loop->iteration}}</th>
				      <td>{{$dt->kode_order}}</td>
				      <td>{{$dt->no_meja}}</td>
				      <td>{{date('d F Y - H:i', strtotime($dt->created_at))}}</td>
				      <td>{{$dt->fullname}}</td>
				      <td>{{$dt->keterangan}}</td>
				      <td>
				      	<?php 
			            if ($dt['status_order']=='Pending') {
			                echo "<span class='badge badge-warning text-secondary'>Menunggu Diantar</span>";
			            } elseif($dt['status_order']=='Menunggu Pembayaran') {
			            	echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
			            } elseif($dt['status_order']=='Beres') {
			            	echo "<span class='badge badge-success'>Beres</span>";
			            } else {
			            	echo "<span class='badge badge-danger'>Dibatalkan</span>";
			            }
			     		?>
				      </td>

				      <td>
				          <a href="{{route('admin.order.edit', ['id_order'=>$dt->id_order])}}" class="btn btn-success btn-sm">
				          	<span class="oi oi-pencil"></span>
				          </a>

				          <button class="btn btn-danger btn-sm btn-trash"
				          data-id="{{$dt->id_order}}"
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
					<form id="form-delete" action="{{ route('admin.order') }}" method="post" >
						@method('delete')
						@csrf
						<input type="hidden" name="id_order" id="input-id">
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
			id_order = $(this).attr('data-id');
			$('#input-id').val(id_order);
			$('#deleteModal').modal('show');
		});

		$('.btn-delete').click(function() {
			$('#form-delete').submit();
		});

	})
</script>

@endpush