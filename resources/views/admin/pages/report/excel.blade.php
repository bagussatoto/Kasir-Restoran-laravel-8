
<h2 align="center">Laporan Semua Transaksi</h2>
<br>
  <table align="center" style="width: 100%;">
      <thead>
        <tr style="text-align: left;">
          <th scope="col">No</th>
          <th scope="col">Pemesan</th>
          <th scope="col">Kode Delivery</th>
          <th scope="col">Kode Transaksi</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $dt)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$dt->fullname}}</td>
          <td>{{$dt->kode_order}}</td>
          <td>{{$dt->kode_transaksi}}</td>
          <td>{{date('d F Y H:i', strtotime($dt->created_at))}}</td>
          <td>Rp.{{number_format($dt->subtotal,0,',','.')}},</td>
        </tr>
        @endforeach
      </tbody>
</table>

<h4 align="center">Jumlah Pendapatan : Rp.{{number_format($pendapatan,0,',','.')}},</h4>