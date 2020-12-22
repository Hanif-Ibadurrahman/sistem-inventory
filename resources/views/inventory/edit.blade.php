@extends('layouts-sistem-inventory.app')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="card">
            <div class="card-header">
                <h5 class="title">Update Inventory</h5>
            </div>

            <div class="card-body">
                  <form method="POST" action="{{route('inventory.update', $inventory->id)}}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Label Loker</label>                                
                                <input type="text" style="text-align: center;" class="form-control" readonly name="label_loker" id="label_loker" value="{{$loker->label_loker}}">
                            </div>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Inventory</label>                                
                                <input type="text" class="form-control"  placeholder="Nama Inventory" name="nama_inventory" id="nama_inventory" required="required" value="{{$inventory->nama_inventory}}">                           
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>                                
                                <input type="text" class="form-control"  placeholder="Jumlah" name="jumlah" id="jumlah" required="required" value="{{$inventory->jumlah}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pemilik</label>                                
                                <input type="text" class="form-control"  placeholder="Pemilik" name="pemilik" id="pemilik" required="required" value="{{$inventory->pemilik}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control"  placeholder="Deskripsi" name="deskripsi" id="deskripsi" required="required" value="{{$inventory->deskripsi}}">
                            </div>
                        </div>
                    </div>

                    <div>
                        <td>
                            <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">UPDATE</button>
                        </td>
                    </div>       
                  </form>
            </div>
        </div>
    </div>

<div class="col-lg-3">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">KONDISI</h5>
        <h4 class="card-title">Loker </h4>
        <div class="dropdown">
          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('inventory.lock', $loker->id)}}" onclick="return confirm('Edit State ?')";>LOCK</a>
            <a class="dropdown-item" href="{{route('inventory.unlock', $loker->id)}}" onclick="return confirm('Edit State ?')";>UNLOCK</a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="chart-area" align="Center">
              <tr class=" text-primary">
                <th >
                    <h3>DOORLOCK</h3>
                </th>
              </tr>
               <tr class=" text-primary">
                 <td>
                    @if($loker->status === 1)
                    <h1>OPEN</h1>
                    @else
                    <h1>LOCK</h1>
                    @endif
                 </td>
               </tr>
        </div>
      </div>

      <div class="card-footer">
        <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Just Updated
          </div>
      </div>

    </div>
</div>

<div class="col-lg-3">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">KONDISI</h5>
        <h4 class="card-title">Loker </h4>
        <div class="dropdown">
          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('inventory.active', $loker->id)}}" onclick="return confirm('Edit State ?')";>ACTIVE</a>
            <a class="dropdown-item" href="{{route('inventory.disabled', $loker->id)}}" onclick="return confirm('Edit State ?')";>DISABLED</a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="chart-area" align="Center">
            <tr class=" text-primary">
              <th >
                <h3>STATE</h3>
              </th>
            </tr>
          
            <tr class=" text-primary">
              <td>
                @if($loker->aktif === 1)
                <h1>ACTIVE</h1>
                @else
                <h2>DISABLED</h2>
                @endif
              </td>
            </tr>
        </div>
      </div>

      <div class="card-footer">
        <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i> Just Updated
          </div>
      </div>

      </div>
    </div>
  </div>               
</div>
@endsection