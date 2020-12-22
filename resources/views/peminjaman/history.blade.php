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
                          <div class="panel-heading"><h3>Riwayat Peminjaman</h3></div><br>
                          <div class="panel-body">
                       
                                    
                              <form action="{{route('peminjaman.search')}}" method="POST">
                                @csrf
                                  <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Pencarian..." id="keyword" name="keyword">                        
                                      <span class="input-group-btn">
                                          <button class="btn btn-primary" type="submit" id="btn-search">SEARCH</button>
                                          <a href="" class="btn btn-warning">RESET</a>              
                                      </span>          
                                  </div>
                              </form>

                          <br>
                          <div class="row">
                              <div>
                                <a href="">EXPORT</a>
                              </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered">                                
                                      <tr style="text-align: center;">
                                        <th>NO</th>
                                        <th>NO. PEMINJAMAN</th>
                                        <th>PEMINJAM</th>
                                        <th>LABEL LOKER</th>
                                        <th>NAMA INVENTORY</th>
                                        <th>JUMLAH</th>
                                        <th>PEMILIK</th>
                                        <th>DESKRIPSI</th>
                                        <th>LOKASI</th>
                                        <th>KETERANGAN</th>
                                        <th>STATUS PEMINJAMAN</th>
                                        <th>DIBOOKING</th>
                                        <th>DIPINJAM</th>
                                        <th>DIKEMBALIKAN</th>
                                      </tr>
                                    
                                    @if(!empty($history))
                                      @foreach($history as $h)
                                      <tr style="text-align: center;">
                                        <td class="align-middle">{{$i++}}</td>
                                        <td class="align-middle">{{$h->no_peminjaman}}</td>
                                        <td class="align-middle">{{$h->email}}</td>
                                        <td class="align-middle">{{$h->label_loker}}</td>
                                        <td class="align-middle">{{$h->nama_inventory}}</td>
                                        <td class="align-middle">{{$h->jumlah}}</td>
                                        <td class="align-middle">{{$h->pemilik}}</td>
                                        <td class="align-middle">{{$h->deskripsi}}</td>
                                        <td class="align-middle">{{$h->lokasi}}</td>
                                        <td class="align-middle">{{$h->alasan_peminjaman}}</td>
                                        <td class="align-middle">{{$h->status_peminjaman}}</td>
                                        <td class="align-middle">{{$h->created_at}}</td>
                                        <td class="align-middle">{{$h->dipinjam}}</td>
                                        <td class="align-middle">{{$h->dikembalikan}}</td>
                                      </tr>
                                      @endforeach
                                    @else
                                    <tr style="text-align: center;">
                                      <td class="align-middle">Empty</td>
                                    </tr>
                                    @endif
                                  </table>
                                  {{ $history->links() }}
                                </div>
                            </div>
                        </div>

                          </div>
                          <div class="panel-footer"><small>© <?= date('Y') ?> <a href="www.pnj.ac.id">PNJ</a></small></div>
                      </div>
                  </div>
                </div>
          </div>
      </div>
    </div>
  </div>
</div>
@endsection