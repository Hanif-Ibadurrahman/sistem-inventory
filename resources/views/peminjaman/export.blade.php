<table border="3">
    <thead>
    <tr>
        <th>NO</th>
        <th>NO. PEMINJAMAN</th>
        <th>PEMINJAM</th>
        <!-- <th>LABEL LOKER</th> -->
        <th>NAMA INVENTORY</th>
        <!-- <th>JUMLAH</th>
        <th>PEMILIK</th>
        <th>DESKRIPSI</th>
        <th>LOKASI</th> -->
        <th>KETERANGAN</th>
        <th>STATUS PEMINJAMAN</th>
        <th>DIBOOKING</th>
        <th>DIPINJAM</th>
        <th>DIKEMBALIKAN</th>
    </tr>
    </thead>
    <tbody>
        @if(!empty($history))
          @foreach($history as $h)
          <tr >
            <td >{{$i++}}</td>
            <td >{{$h->no_peminjaman}}</td>
            <td >{{$h->email}}</td>
            <!-- <td >{{$h->label_loker}}</td> -->
            <td >{{$h->nama_inventory}}</td>
            <!-- <td >{{$h->jumlah}}</td>
            <td >{{$h->pemilik}}</td>
            <td >{{$h->deskripsi}}</td>
            <td >{{$h->lokasi}}</td> -->
            <td >{{$h->alasan_peminjaman}}</td>
            <td >{{$h->status_peminjaman}}</td>
            <td >{{$h->created_at}}</td>
            <td >{{$h->dipinjam}}</td>
            <td >{{$h->dikembalikan}}</td>
          </tr>
          @endforeach
        @else
        <tr >
          <td >Empty</td>
        </tr>
        @endif
    </tbody>
</table>
                        