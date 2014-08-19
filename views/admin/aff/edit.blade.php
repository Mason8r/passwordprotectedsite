@extends('admin.layout')

@section('content')

	<h3>Edit Affilaite {{$affiliate->email}}</h3>
  <div class="row">
<div class="col-md-6 col-md-offset-3">
  <form role="form" action="{{url('admin/edit-aff', $affiliate->id)}}" method="post">
      
        <label for="name">Affiliate Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Affiliate Name" value="{{ Input::old('name' , $affiliate->name ) }}">
        <p class="text-warning">{{$errors->first('name')}}</p>

        <label for="url">URL (only the bit at the end)</label>
        <input type="text" name="url" class="form-control" id="url" placeholder="Last Name" value="{{ Input::old('url' , $affiliate->url ) }}">
        <p class="text-warning">{{$errors->first('url')}}</p>    

      <hr /> 

      <button type="submit" class="btn btn-default">Edit Affiliate</button> <a href="{{url('admin')}}" class="btn btn-warning">Cancel</a>
      <hr />
  </form> 
  </div>
</div>

@stop