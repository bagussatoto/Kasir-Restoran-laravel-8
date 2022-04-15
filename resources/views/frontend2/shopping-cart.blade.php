@extends('layouts.main2')
@section('title','Keranjang Anda')
@push('css')
<link rel="stylesheet" href="{{url('polished/js/swal/sweetalert2.min.css')}}">
@endpush
@section('content')

<div class="container" id="cart">
	<h1 align="center"><span class="oi oi-cart"></span> Keranjang</h1>
	
	@if(Session::has('cart'))
	
		<div class="row">

			<div class="col-md-9 mx-auto">
				<a href="{{route('cancel')}}" class="btn btn-danger cancel mr-2 mb-2"><span class="oi oi-trash"></span> Batal Memesan</a><a class="btn btn-success mb-2" href="{{route('menu-masakan')}}"><span class="oi oi-arrow-circle-left"></span> Pesan Menu Lagi</a>
				<div class="table-responsive-md">
					<table class="table">
					  <thead class="thead-dark">
					    <tr>
					      <th scope="col">#</th>
					      <th scope="col">Gambar</th>
					      <th scope="col">Nama Masakan</th>
					      <th scope="col">Harga Satuan</th>
					      <th scope="col">Jumlah Pesanan</th>
					      <th scope="col">Subtotal</th>
					      <th scope="col">Aksi</th>
					    </tr>
					  </thead>
					  <tbody>
					  	@foreach($data as $dt)
					    <tr>
					      <th scope="row">{{$loop->iteration}}</th>
					      <td>
					      	<img src="{{url('storage/gambar/'.$dt['item']['gambar'])}}" alt="Gambar Masakan" class="img-thumnail" width="50px">
					      </td>
					      <td>{{$dt['item']['nama_masakan']}}</td>
					      <td>Rp.{{number_format($dt['item']['harga'],0,',','.')}},</td>
					      <td>
					      	<a class="btn btn-danger btn-sm" href="{{route('reducebyone', ['id' => $dt['item']['id']])}}"><span class="oi oi-minus"></span></a>
					      	<span class="btn btn-secondary" disabled><b>{{$dt['qty']}}</b></span>
					      	<a class="btn btn-success btn-sm" href="{{route('addone', ['id' => $dt['item']['id']])}}"><i class="oi oi-plus" aria-hidden="true"></i></a>
					      </td>
					      <td>Rp.{{number_format($dt['harga'],0,',','.')}},</td>
					      <td>
							  <a class="btn btn-danger btn-sm" href="{{route('remove.items', ['id' => $dt['item']['id']])}}"><span class="oi oi-x"></span></a>
					      </td>
					    </tr>
					    @endforeach
					  </tbody>
					</table>
				</div>
				<strong class="float-right" style="color: green; text-transform: uppercase;">Total : Rp.{{number_format($totalPrice,0,',','.')}},</strong>
				<br>
				<!-- <strong class="float-right" style="color: grey; text-transform: uppercase;">PPN 10%: Rp.{{number_format(7000,0,',','.')}},</strong>
				<br>
				<strong class="float-right" style="color: green; text-transform: uppercase;">Grandtotal : Rp.{{number_format($totalPrice+7000,0,',','.')}},</strong>
				<br> -->
				<a href="{{route('checkout')}}" class="btn btn-success float-right"><span class="oi oi-check"></span> Checkout</a>
			 </div>	
					
		</div>
	@else
		<div class="row">
			<div class="col pt-5 mx-auto">
				<h3 class="text-muted">Tidak Ada Pesanan Dikeranjang :(</h3>
				<br>
				<a href="{{route('menu-masakan')}}" class="btn btn-success">Ke Menu Masakan</a>
			</div>
		</div>
	@endif





</div>

@endsection

@push('js')
<script type="text/javascript">
    $('.cancel').on('click', function (e) {

      e.preventDefault();
      const href = $(this).attr('href');

      Swal.fire({
        title: 'Batal memesan?',
        text: "Apakah anda ingin membersihkan semua data dikeranjang?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya bersihkan!'
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        }
      })

    });    

</script>
@endpush