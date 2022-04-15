@extends('layouts.main2')
@section('title','Daftar Menu Masakan')
<style>
	.img-fluid{
		filter: brightness(50%);
		object-fit: cover;
	}

	.carousel-caption {
		top: 0px;
		text-shadow: 1px 1px black;
	}

	.container {
		background: #fff;
		border-radius: 20px;
		position: relative;
		top: -150px;
		box-shadow: 0 3px 20px rgba(0,0,0,0.5);
		
	}

	@media (min-width: 576px) { 
		.carousel-caption {
		top: -15px;
		text-shadow: 1px 1px black;
	}
	}

</style>
@section('content')

<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="img-fluid d-block w-100 h-50" src="{{url('polished/assets/bg2.png')}}" alt="First slide">
      <div class="carousel-caption">
	    <h1 class="mt-5"><?php 
	          date_default_timezone_set("Asia/Jakarta");

	            $b = time();
	            $hour = date("G",$b);

	            if ($hour>=0 && $hour<=11)
	            {
	            echo "Selamat Pagi";
	            }
	            elseif ($hour >=12 && $hour<=14)
	            {
	            echo "Selamat Siang";
	            }
	            elseif ($hour >=15 && $hour<=17)
	            {
	            echo "Selamat Sore";
	            }
	            elseif ($hour >=17 && $hour<=18)
	            {
	            echo "Selamat Petang";
	            }
	            elseif ($hour >=19 && $hour<=23)
	            {
	            echo "Selamat Malam";
	            }

	       ?>, {{Auth::user()->fullname}}
	    </h1>
	    <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">Petunjuk Order</button>
	  </div>
    </div>
  </div>
</div>

<div class="container" id="menu">

	<h2>Daftar Menu Masakan</h2>

	<div class="row mb-4">
		<div class="col-md-7">
			<form method="GET" action="{{ route('menu-masakan') }}">
	        @csrf
	        <div class="input-group">
	          <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control border-success" placeholder="Cari Sesuatu..." id="keyword" autofocus>
	          <button type="submit" class="btn btn-success">Cari</button>
	        </div>
	      </form>
		</div>

		<div class="col-md-5">
	      <div class="float-right">
		      	<?php
		    	 $kategori = App\Kategori::get();
		    	  ?>

				<div class="btn-group dropleft">
				  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    Filter by Kategori
				  </button>
				    <div class="dropdown-menu">
				    	<a class="dropdown-item category" href="{{route('menu-masakan')}}">Semua Menu</a>
				    @foreach($kategori as $dt)
					  <a class="dropdown-item category" href="{{route('show.category', ['id'=> $dt->id])}}">{{$dt->nama_kategori}}</a>
					@endforeach  
					</div>
				</div>

			</div>
		</div>	
    </div>


    @if(session('result') == 'success')
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>1 Item Ditambahkan!</strong> Anda Telah Menambahkan Item Ke Keranjang Anda. <strong>Ayo Pesan Lagi.</strong> Atau Mau <span class="oi oi-arrow-thick-right"></span> <a href="{{route('shopping.cart')}}" class="btn btn-success btn-sm"><span class="oi oi-cart"></span> Lihat Keranjang</a>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@elseif(session('result') == 'clear')
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>Terhapus!</strong> Anda Telah Menghapus Semua Item Keranjang Anda. <strong>Ayo Silahkan Pesan!</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endif

	@if($data->isEmpty())
	<div class="col">
		<h4 class="text-center text-muted">Menu tidak tersedia...</h4>
	</div>
	@else
	<div class="row">
		@foreach($data as $dt)
		<div class="col-md-4 pb-4">
			<div class="card-group">
			  <div class="card">
			    <a href="{{url('storage/gambar/'.$dt->gambar)}}"><img class="card-img-top img-responsive" src="{{url('storage/gambar/'.$dt->gambar)}}" style="width: 100%; height: 280px;"></a>
			    <div class="card-body">
			      <small>{{$dt->kode_masakan}} | {{$dt->nama_kategori}}</small>	
			      <h5 class="card-title">{{$dt->nama_masakan}}</h5>
			      <p>
			      	<?php 
		            if ($dt['status_masakan']=='Ada') {
		                echo "<span class='badge badge-success'>Ada</span>";
		            } else {
		                echo "<span class='badge badge-danger'>Habis</span>";
		            }
		     		?>
			      </p>
			      <p class="card-text">Rp.{{number_format($dt->harga,0,',','.')}},</p>
			    </div>
			    <div class="card-footer">
			    	@if($dt['status_masakan']=='Ada')
			      		<a href="{{route('add.cart', ['id' => $dt->id])}}" class="btn btn-success btn-block"><span class="oi oi-cart"></span> Pesan</a>
			        @else
			       		 <button type="button" class="btn btn-secondary btn-block" title="Stok Habis" disabled><span class="oi  oi-circle-x"></span> Stok Habis</button>
			        @endif
			    </div>
			  </div>
			</div>
		</div>
		@endforeach
	</div>
	@endif

	{{
		$data->links('vendor.pagination.bootstrap-4')
	}}
	<br>

</div>


@endsection

@push('modal')
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center">PETUNJUK PENGGUNAAN APLIKASI</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="guide">
			<img src="{{url('polished/assets/guide/brand.png')}}" width="">
			<small class="text-muted">Gambar 1</small>
			<p>1. Brand Logo untuk mengenalkan logo restaurant sekaligus menjadi <b>navigasi ke menu awal</b>.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/1.png')}}" width="">
			<small class="text-muted">Gambar 2</small>
			<p>2. Dua Tombol tersebut adalah navigasi untuk menuju keranjang dan riwayat order.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/2.png')}}" width="70%">
			<small class="text-muted">Gambar 3</small>
			<p>3. Kolom pencarian untuk <b>mencari menu sesuai dengan yang anda ketik</b>.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/3.png')}}" width="40%">
			<small class="text-muted">Gambar 4</small>
			<p>4. Ini untuk mengelompokan menu sesuai dengan kategorinya masing-masing.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/4.png')}}" width="70%">
			<small class="text-muted">Gambar 5</small>
			<p>5. Menu Masakan dengan tombol yang bila anda tekan akan langsung masuk kedalam keranjang anda, <b>Untuk tombol dengan stok habis tidak bisa dipesan karena stok menunya sedang tidak tersedia</b> .</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/4.1 add.png')}}" width="70%">
			<small class="text-muted">Gambar 6</small>
			<p>6. Tanda anda sudah menambahkan item menu kedalam keranjang anda.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/keranjang.png')}}" width="70%">
			<small class="text-muted">Gambar 7</small>
			<p>7. Anda bisa kelola keranjang anda terlebih dahulu sebelum memesan menu <b>dan jika anda mau memesan tinggal tekan tombol checkout</b> .</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/keranjang remove alert.png')}}" width="70%">
			<small class="text-muted">Gambar 8</small>
			<p>8. akan muncul pop up verifikasi jika anda ingin menghapus semua data keranjang anda.</p>
			<img src="{{url('polished/assets/guide/keranjang terhapus.png')}}" width="70%">
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/checkout.png')}}" width="60%">
			<small class="text-muted">Gambar 9</small>
			<p>9. Isikan data Meja yang sedang anda tempati dengan benar dan masukan keterangan terkait menu yang dipesan bila perlu.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/meja digunakan.png')}}" width="60%">
			<small class="text-muted">Gambar 10</small>
			<p>10. Jika anda sengaja memasukan ke nomor meja lain/secara tidak sengaja salah menginputkan, akan muncul peringatan bahwa meja tersebut sudah dipesan yang lain <b>jadi masukan nomor meja sesuai yang tertera dimeja anda sendiri</b>.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/alert beres order.png')}}" width="60%">
			<small class="text-muted">Gambar 11</small>
			<p>11. Akan muncul pop up berhasil memesan jika anda sudah benar memasukan nomor mejanya <b>itu sebagai tanda bahwa anda telah memesan menu yang dipesan</b>.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/detail order.png')}}" width="70%">
			<small class="text-muted">Gambar 12</small>
			<p>12. Akan muncul detail order anda di halaman jika anda menekan oke <i>di gambar 11</i>.</p>
		</div>
		<hr>
		<div class="guide">
			<img src="{{url('polished/assets/guide/riwayat.png')}}" width="70%">
			<small class="text-muted">Gambar 13</small>
			<p>13. Halaman ini adalah riwayat pemesanan dari user ini sendiri.</p>
		</div>
		<hr>
		<div class="guide">
			14. <b>Mengenal status :</b>
			<p><span class='badge badge-success'>Beres</span> = pesanan telas beres dan menu sudah sampai di meja anda.</p>
			<p><span class='badge badge-primary bounce'>Menunggu Diantar</span> = pesanan anda sedang dimasak, tunggu hingga waiter datang mengantarkan pesanan anda.</p>
			<p><span class='badge badge-warning'>Menunggu Pembayaran</span> = menunggu pembayaran untuk pesanan ini, silahkan anda menuju kasir untuk melakukan transaksi.</p>
			<p><span class='badge badge-danger'>Dibatalkan</span> = pesanan dibatalkan karena adanya kesalahan teknis dari server maupun pelanggan.</p>
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endpush

@push('js')
<script type="text/javascript">
	$(function () {
		var current = window.location.href;
		$('.dropdown-item').each(function(){
			var $this = $(this);
			if ($this.attr('href') == current ) {
				$(this).addClass('active');
			}
		});
	});
</script>
@endpush