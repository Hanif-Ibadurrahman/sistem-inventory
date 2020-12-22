@extends('layouts-sistem-inventory.app')
@section('content')
<div class="content">
  <div class="row">

  <div class="col-lg-4">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">INFO</h5>
        <h4 class="card-title">INVENTORY</h4>
        <div class="dropdown">
          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{url('inventory')}}">View</a>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="chart-area" align="Center">
          

      <tr class=" text-primary">
        <th >
            <h3>JUMLAH</h3>
        </th>
      </tr>

      <tr class=" text-primary">
        <td>
          <h1>{{$inventory}}</h1>
        </td>
      </tr>
                 
        </div>
      </div>

      <div class="card-footer">
        <div class="stats">
              <i class="now-ui-icons loader_refresh spin"></i>Just Updated
          </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4 col-md-6">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">INFO</h5>
        <h4 class="card-title">ANGGOTA ADMIN</h4>
        <div class="dropdown">
          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{url('information')}}">View</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="chart-area" align="Center"> 
          <tr class=" text-primary">
            <th >
                <h3>JUMLAH</h3>
                </th>
            </tr>

          <tr class=" text-primary">
            <td>
                <h1>{{$admin}}</h1>
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
  
  <div class="col-lg-4 col-md-6">
    <div class="card card-chart">
      <div class="card-header">
        <h5 class="card-category">INFO</h5>
        <h4 class="card-title">ANGGOTA MEMBER</h4>
                <div class="dropdown">
          <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
              <i class="now-ui-icons loader_gear"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{url('information')}}">View</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="chart-area" align="Center">
    
            <tr class=" text-primary">
              <th >
                <h3>JUMLAH</h3>
              </th>
            </tr>

            <tr class=" text-primary">
              <td>
                <h1>{{$member}}</h1>
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