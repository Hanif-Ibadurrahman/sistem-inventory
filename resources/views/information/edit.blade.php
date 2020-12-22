@extends('layouts-sistem-inventory.app')
@section('content')
<div class="content">                    
  <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="title">Information</h5>
            </div>

            <div class="card-body">
                 <form method="POST" action="{{route('information.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Nama</label>                                
                                <input type="text" class="form-control" readonly required="required" name="name" id="name" value="{{$user->name}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" readonly name="email" id="email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Role</label>
                                <select type="text" class="form-control" name="role" id="role">
                                    @foreach($roles as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach
                                </select>
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
  </div>               
</div>
@endsection