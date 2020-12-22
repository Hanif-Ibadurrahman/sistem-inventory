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
                          <div class="panel-heading"><h3>Daftar Inventory Yang Tersedia</h3></div><br>
                          <div class="panel-body">

                          <div>
                            <i class="now-ui-icons loader_refresh spin"></i><a type="button" onclick="">Refresh</a>
                            
                            <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th>LABEL LOKER</th>
                                            <th>NAMA INVENTORY</th>
                                            <th>JUMLAH</th>
                                            <th>PEMILIK</th>
                                            <th>DESKRIPSI</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($listInventory as $l)
                                        <tr>
                                            <td style="text-align: center;">
                                                {{$l->label_loker}}
                                            </td>
                                            <td>
                                                {{$l->nama_inventory}}
                                            </td>
                                            <td style="text-align: center;">
                                                {{$l->jumlah}}
                                            </td>
                                            <td style="text-align: center;">
                                                {{$l->pemilik}}
                                            </td>
                                            <td>
                                                {{$l->deskripsi}}
                                            </td>
                                            <td class="text-center">                     
                                                <a class="aksi" href="{{route('inventory.edit', $l->id)}}" onclick="return confirm('Edit Inventory?')";>Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                          </div>
                          </div>
        
                          <div id="demo">
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