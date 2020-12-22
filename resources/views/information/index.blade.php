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
                          <div class="panel-heading"><h3>All Users</h3></div><br>
                          <div class="panel-body">
                       
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">                        
                                      <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>              
                                        <a href="" class="btn btn-warning">RESET</a>
                                      </span>          
                                    </div>

                          <br>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                  <tr style="text-align: center;">
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>EMAIL</th>
                                    <th>ROLE</th>
                                    <th>Action</th>
                                    <th>Action</th>
                                  </tr>

                                  @foreach($user as $s)
                                  <tr style="text-align: center;">
                                    <td class="align-middle">{{$i++}}</td>
                                    <td class="align-middle">{{$s->name}}</td>
                                    <td class="align-middle">{{$s->email}}</td>
                                    <td class="align-middle">{{$s->getRoleNames()}}</td>
                                    <td>
                                      <a href="{{route('information.edit', $s->id)}}" onclick="return confirm('Edit User?')";>Edit</a>
                                      </td>
                                    <td>
                                      <a href="" onclick="return confirm('Hapus User?')";>Hapus</a>
                                    </td>
                                  </tr>
                                  @endforeach

                                </table>
                                {{ $user->links() }}
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