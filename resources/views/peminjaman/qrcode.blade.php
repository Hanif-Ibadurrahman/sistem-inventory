@extends('layouts-sistem-inventory.app')
@section('content')
<div class="content">
  <div class="row">
    <div class="col-lg-6">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">QR Code</h5>
            <h4 class="card-title">Scan This</h4>
          </div>

          <div class="card-body">
            <div class="chart-area" align="Center">
                <img src="data:image/png; base64, {{$qrcode}}"/>
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