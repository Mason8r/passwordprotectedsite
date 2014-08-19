@extends('admin.layout')

@section('content')

    <div class="row">
      <div class="col-md-12">
        <h3>Create New Affiliate</h3>
  <form role="form" action="{{url('admin/create-aff')}}" method="post">
      
        <label for="name">Affiliate Name</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Affiliate Name" value="{{ Input::old('name') }}">
        <p class="text-warning">{{$errors->first('name')}}</p>

        <label for="url">URL (only the bit at the end)</label>
        <input type="text" name="url" class="form-control" id="url" placeholder="Last Name" value="{{ Input::old('url') }}">
        <p class="text-warning">{{$errors->first('url')}}</p>    

      <hr /> 

      <div class="form-group">
        <label for="form_data[url]">Additional Data for the form:</label>
        <input type="text" name="form_data[url]" class="form-control" id="form_data" placeholder="Additional Form Data - URL">
        <p class="text-warning">{{$errors->first('form_data[url]')}}</p>
      </div>

      <hr />

      <button type="submit" class="btn btn-default">Add Affiliate</button> <a href="{{url('admin')}}" class="btn btn-warning">Cancel</a>
      <hr />
  </form>               
      </div>        
    </div>

@stop