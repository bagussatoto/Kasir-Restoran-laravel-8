
<h2 align="center">Laporan Semua Transaksi</h2>
<br>
  <table align="center" style="width: 100%; border-collapse: collapse; border: 1px solid grey; padding: 8px;">
      <thead>
        <tr style="text-align: left;">
          <th style="border: 1px solid grey;" scope="col">#</th>
          <th style="border: 1px solid grey;" scope="col">Pemesan</th>
          <th style="border: 1px solid grey;" scope="col">Kode Delivery</th>
          <th style="border: 1px solid grey;" scope="col">Kode Transaksi</th>
          <th style="border: 1px solid grey;" scope="col">Tanggal</th>
          <th style="border: 1px solid grey;" scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($data as $dt)
        <tr>
          <th style="border: 1px solid grey;" scope="row">{{$loop->iteration}}</th>
          <td style="border: 1px solid grey;">{{$dt->fullname}}</td>
          <td style="border: 1px solid grey;">{{$dt->kode_order}}</td>
          <td style="border: 1px solid grey;">{{$dt->kode_transaksi}}</td>
          <td style="border: 1px solid grey;">{{date('d F Y H:i', strtotime($dt->created_at))}}</td>
          <td style="border: 1px solid grey;">Rp.{{number_format($dt->subtotal,0,',','.')}},</td>
        </tr>
        @endforeach
      </tbody>
</table>

<h4 align="center">Jumlah Pendapatan : Rp.{{number_format($pendapatan,0,',','.')}},</h4>