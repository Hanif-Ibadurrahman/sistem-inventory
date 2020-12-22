@extends('layouts-sistem-inventory.app')

@section('content')
<div class="content">
  <div class="row">

<div class="col-md-6">
  <div class="card">
            <div class="card-header">
                <h5 class="title">SETTING DELETE OTOMATIS</h5>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <p align="justify">Menghapus record user yang belum melakukan verifikasi email secara otomatis berdasarkan lama durasi yang dimasukkan dalam satuan hari.</p>
                </div>

                <tr class=" text-primary">
                  <th >
                    Hapus record user dalam =
                  </th>
                </tr>

                <tr>
                  <td class="text-left">
                    {{$setting->durasi_delete}} Hari
                  </td>
                </tr>

               <hr>
                  <form method="POST" action="{{route('setting.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Jumlah Hari</label>                                
                                <input type="number" min="1" required="required" class="form-control"  placeholder="Jumlah Hari" name="durasi_delete" id="durasi_delete" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">UPDATE</button>
                    </div>
                    
                  </form>
            </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
        <h5 class="title">SETTING QR CODE</h5>
    </div>
      <div class="card-body">
        <div class="table-full-width table-responsive">
          <table class="table">
            <tbody>
              <tr class=" text-primary">
                <th >
                  Kualitas QR Code
                </th>
                <th >
                  Size QR Code
                </th>
              </tr>

              <tr>
                <td class="text-left">
                  
                </td>
                <td class="text-left">
                  
                </td>
              </tr>

            </tbody>
          </table>
        </div>

        <hr>
          
        <form method="POST" action="">
          <div class="form-group">
            <label>SIZE</label>
            <select type="text" name="size" id="size" class="form-control">
              <option value=""></option>
            </select>
          </div> 

          <div class="form-group">
            <label>KUALITAS</label>
            <select type="text" name="kualitas" id="kualitas" class="form-control">
              <option value=""></option>
            </select>
          </div>
                  
          <div>
            <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">UPDATE</button>
          </div>
        </form>                 

      </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
            <div class="card-header">
                <h5 class="title">SETTING WAKTU BOOKING</h5>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <p align="justify">Maksimal waktu booking yang diberikan kepada peminjam dalam satuan menit, ketika melewati batas yang diberikan QR code akan kadaluarsa.</p>
                </div>

                <tr class=" text-primary">
                  <th >
                    Maksimal waktu booking dalam =
                  </th>
                </tr>

                <tr>
                  <td class="text-left">
                   {{$setting->durasi_booking}} Menit
                  </td>
                </tr>

               <hr>
               <body>
                  <form method="POST" action="{{route('setting.store')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Waktu Booking</label>                                
                          <input type="number" min="1" max="59" class="form-control" required="required" placeholder="dalam satuan menit" name="durasi_booking" id="durasi_booking" value="">
                        </div>
                      </div>
                    </div>

                    <div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">UPDATE</button>
                    </div>
                  </form>
                </body>
            </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
            <div class="card-header">
                <h5 class="title">SETTING BATAS WAKTU PENGEMBALIAN</h5>
            </div>

            <div class="card-body">
                <div class="alert alert-info">
                    <p align="justify">Batas waktu dimana peminjam harus mengembalikan barang yang dipinjam.</p>
                </div>

                <tr class=" text-primary">
                  <th >
                    Jam Pengembalian Barang, Pukul = {{$setting->waktu_pengembalian}}
                  </th>
                </tr>

                <tr>
                  <td class="text-left">
                    WIB
                  </td>
                </tr>

               <hr>
               <body>
                  <form method="POST" action="{{route('setting.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Batas Waktu Pengembalian</label>
                                <input type="text" class="form-control col-sm-3 simpleExample" required="required" placeholder="dalam satuan menit" name="waktu_pengembalian" id="waktu_pengembalian" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                      <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">UPDATE</button>
                    </div>
                  </form>
                </body>
            </div>
  </div>
</div>

  <div class="col-md-6">
    <div class="card">
            <div class="card-header">
                <h5 class="title">ADD INVENTORY</h5>
            </div>

            <div class="card-body">
               <body>
                  
                  <form method="POST" action="{{route('setting.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Label Loker</label>                                
                                <input type="number" min="1" class="form-control" required="required" placeholder="Label Loker" name="label_loker" id="label_loker" value="">
                            </div>
                            @error('label_loker')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Inventory</label>                                
                                <input type="text" class="form-control" required="required"  placeholder="Nama Inventory" name="nama_inventory" id="nama_inventory" value="">
                            </div>
                            @error('nama_inventory')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>                                
                                <input type="number" min="1" class="form-control" required="required"  placeholder="Jumlah" name="jumlah" id="jumlah" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemilik</label>                                
                                <input type="text" class="form-control" required="required"  placeholder="Pemilik" name="pemilik" id="pemilik" value="">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" required="required"  placeholder="Deskripsi" name="deskripsi" id="deskripsi" value="">
                            </div>
                        </div>
                    </div>

                    <div>
                      <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">ADD</button>
                    </div>
                  </form>

                </body>
            </div>

        </div>
    </div>

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h5 class="title">ADD MEMBER</h5>
    </div>
    
    <div class="card-body">
      <form method="POST" action="{{route('setting.store')}}">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>*EMAIL</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="email.example@tik.pnj.ac.id" required="required" value="">
              </div>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror              
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>*ROLE</label>
                    <select type="text" name="role" id="role" class="form-control">                
                      @foreach($roles as $r)
                      <option value="{{$r->id}}">{{$r->name}}</option> 
                      @endforeach
                    </select>
              </div>
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                <label>*NIK/NIP</label>
                    <input type="number" min="1" name="nip" id="nip" class="form-control" placeholder="" required="required" value="">
              </div>
                    @error('nip')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror              
            </div>

            <div class="col-md-12">
                <hr>
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">ADD</button>
            </div>
           </div>                     
          </div>                
      </form>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card">
    <div class="card-header">
      <h5 class="title">ADD OPTION LOKASI</h5>
    </div>

      <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-bordered">                                
                <tr style="text-align: center;">
                  <th>NO</th>
                  <th>LOKASI</th>
                  <th>ACTION</th>
                </tr>
              
              @if(!empty($lokasi))
                @foreach($lokasi as $l)
                <tr style="text-align: center;">
                  <td class="align-middle">{{$i++}}</td>
                  <td class="align-middle">{{$l->nama_lokasi}}</td>
                  <td class="align-middle">
                    <form action="{{ route('setting.destroy',$l->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Lokasi?')">Delete</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              @else
              <tr style="text-align: center;">
                <td class="align-middle">Empty</td>
              </tr>
              @endif
            </table>
            {!! $lokasi->links() !!}
          </div>
      </div>

    <div class="card-body">     
          <form method="POST" action="{{route('setting.store')}}">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Lokasi</label>
                      <input type="text" class="form-control" required="required" placeholder="Lokasi" name="nama_lokasi" id="nama_lokasi" class="@error('nama_lokasi') is-invalid @enderror" value="">
                  </div>
                  @error('nama_lokasi')
                      <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
              </div>

              <div>
                  <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">ADD</button>
              </div> 
          </form>
    </div>

  </div>
</div>    

  </div>
</div>
@endsection