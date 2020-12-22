@extends('layouts-sistem-inventory.app')

@section('content')
<div class="content">                    
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Profile</h5>
            </div>

            <div class="card-body">
               <body>
                  
                  <form method="POST" action="{{route('peminjaman.store')}}">
                    @csrf
                    <div class="row">
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label>Label Loker</label>                                
                                  <input type="text" class="form-control" placeholder="Label Loker" readonly name="label_loker" id="label_loker" value="{{$loker->label_loker}}">
                              </div>
                          </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Inventory</label>                                
                                <input type="text" class="form-control"  placeholder="Nama Inventory" readonly name="nama_inventory" id="nama_inventory" value="{{$inventory->nama_inventory}}">                           
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>                                
                                <input type="text" class="form-control"  placeholder="Jumlah" readonly name="jumlah" id="jumlah" value="{{$inventory->jumlah}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemilik</label>                                
                                <input type="text" class="form-control"  placeholder="Pemilik" readonly name="pemilik" id="pemilik" value="{{$inventory->pemilik}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control"  placeholder="Deskripsi" readonly name="deskripsi" id="deskripsi" value="{{$inventory->deskripsi}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                                <label>Lokasi</label>
                                <td>
                                <select type="text" name="lokasi" id="lokasi" class="form-control">
                                    @foreach ($lokasi as $l)
                                     <option value="{{$l->nama_lokasi}}">{{$l->nama_lokasi}}</option>
                                    @endforeach
                                </select>
                                </td>
                          </div>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control"  placeholder="alasan melakukan peminjaman, dan lain sebagainya" name="alasan_peminjaman" id="alasan_peminjaman" required="required" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                          <td>
                                <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">PINJAM</button>
                          </td>
                    </div>
                  </form>

                </body>
            </div>

        </div>
    </div>

</div>         
</div>
@endsection