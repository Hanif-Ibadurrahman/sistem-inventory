@extends('layouts-sistem-inventory.app')

@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
          <div class="card-header">
            <h4 class="card-title">Information</h4>
          </div>
          <div class="card-body">
                <div class="container">
                  <div class="col-md-12">
                      <div class="panel panel-primary">
                          <div class="panel-heading"><h4>Inventory Yang Dibooking</h4></div>
                          <div class="panel-body">
        
                          <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr align="Center" style="font-size: 8px">
                                            <th>NO. PEMINJAMAN</th>
                                            <th>LABEL LOKER</th>
                                            <th>NAMA INVENTORY</th>
                                            <th>JUMLAH</th>
                                            <th>PEMILIK</th>
                                            <th>DESKRIPSI</th>
                                            <th>LOKASI</th>
                                            <th>KETERANGAN</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    @foreach($booking as $b)
                                    <tbody>
                                        <tr align="Center">
                                            <td>
                                                {{$b->no_peminjaman}}
                                            </td>
                                            <td>
                                                {{$b->label_loker}}
                                            </td>
                                            <td>
                                                {{$b->nama_inventory}}
                                            </td>
                                            <td>
                                                {{$b->jumlah}}
                                            </td>
                                            <td>
                                                {{$b->pemilik}}
                                            </td>
                                            <td>
                                                {{$b->deskripsi}}
                                            </td>
                                            <td>
                                                {{$b->lokasi}}
                                            </td>
                                            <td>
                                                {{$b->alasan_peminjaman}}
                                            </td>
                                            <td>
                                                <a class="aksi" href="{{route('peminjaman.qrcode', $b->no_peminjaman)}}" onclick="return confirm('View QR Code?')";>View</a>
                                            </td>
                                            <td>
                                                <a class="aksi" href="{{route('peminjaman.cancel', $b->no_peminjaman)}}" onclick="return confirm('Cancel Peminjaman?')";>Cancel</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach

                                </table>
                            </div>
                        </div>

                          </div>
                      </div>

                      <div class="panel panel-primary">
                          <div class="panel-heading"><h4>Inventory Yang Dipinjam</h4></div>
                          <div class="panel-body">
        
                          <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr align="Center" style="font-size: 8px">
                                            <th>NO. PEMINJAMAN</th>
                                            <th>LABEL LOKER</th>
                                            <th>NAMA INVENTORY</th>
                                            <th>JUMLAH</th>
                                            <th>PEMILIK</th>
                                            <th>DESKRIPSI</th>
                                            <th>LOKASI</th>
                                            <th>KONDISI INVENTORY TERKINI</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    @foreach($pinjam as $p)
                                    <tbody>
                                        <tr align="Center">
                                            <td>
                                                {{$p->no_peminjaman}}
                                            </td>
                                            <td>
                                                {{$p->label_loker}}
                                            </td>
                                            <td>
                                                {{$p->nama_inventory}}
                                            </td>
                                            <td>
                                                {{$p->jumlah}}
                                            </td>
                                            <td>
                                                {{$p->pemilik}}
                                            </td>
                                            <td>
                                                {{$p->deskripsi}}
                                            </td>
                                            <td>
                                                {{$p->lokasi}}
                                            </td>
                                            <td>
                                            <form method="POST" action="{{route('peminjaman.update', $p->id)}}">
                                            @csrf
                                            @method('PUT')
                                              <input type="text" style="text-align: center;" class="form-control" placeholder="Deskripsi Kondisi Inventory Terkini" required="required" name="kondisi_inventory" id="kondisi_inventory" value="">
                                            </td>
                                            @if($p['token_return'] == NULL)
                                              <td><button class=btn btn-primary btn-block btn-large type=submit name=submit onclick=return confirm('Kembalikan Pinjaman?');>Kembalikan</button></td>
                                            </form>
                                            @else
                                            <td>
                                              <a class="aksi" href="{{route('peminjaman.return', $p->no_peminjaman)}}" onclick="return confirm('View QR Code Return?')";>View</a>
                                            </td>
                                            @endif

                                        </tr>
                                    </tbody>
                                    @endforeach
                                    
                                </table>
                            </div>
                        </div>

                          </div>
                      </div>

                  </div>
                </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection