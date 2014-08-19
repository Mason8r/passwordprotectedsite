@extends('admin.layout')

@section('content')

	<h3>Edit User {{$user->first_name}} {{$user->last_name}}</h3>
  <div class="row">

<div class="col-md-6">
  <form role="form" action="{{url('admin/edit-user', $user->id)}}" method="post">

        <label for="title">ID</label>
        <p>{{ $user->id }}</p>

        <label for="title">Reg Code</label>
        <p>{{ $user->reg_code }}</p>

        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $user->title }}">
         <p class="text-warning">{{$errors->first('title')}}</p>

         <label for="first_name">First Name</label>
          <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
          <p class="text-warning">{{$errors->first('first_name')}}</p>

         <label for="last_name">Last Name</label>
          <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
          <p class="text-warning">{{$errors->first('last_name')}}</p>

         <label for="company">Company</label>
          <input type="text" name="company" class="form-control" value="{{ $user->company }}">
          <p class="text-warning">{{$errors->first('company')}}</p>

          <label for="street1">Street 1</label>
          <input type="text" name="street1" class="form-control" value="{{ $user->street1 }}">
          <p class="text-warning">{{$errors->first('street1')}}</p>

          <label for="street2">Street 2</label>
          <input type="text" name="street2" class="form-control" value="{{ $user->street2 }}">
          <p class="text-warning">{{$errors->first('street2')}}</p>

         <label for="street3">Street 3</label>
          <input type="text" name="street3" class="form-control" value="{{ $user->street3 }}">
          <p class="text-warning">{{$errors->first('street3')}}</p>

          <label for="city">City</label>
          <input type="text" name="city" class="form-control" value="{{ $user->city }}">
          <p class="text-warning">{{$errors->first('city')}}</p>

          <label for="county">County</label>
          <input type="text" name="county" class="form-control" value="{{ $user->county }}">
          <p class="text-warning">{{$errors->first('county')}}</p>

          <label for="postcode">Postcode</label>
          <input type="text" name="postcode" class="form-control" value="{{ $user->postcode }}">
          <p class="text-warning">{{$errors->first('postcode')}}</p>

          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" value="{{ $user->email }}">
          <p class="text-warning">{{$errors->first('email')}}</p>

          <label for="source">Source</label>
          <input type="text" name="source" class="form-control" value="{{ $user->source }}">
          <p class="text-warning">{{$errors->first('source')}}</p>

          <label for="system">System</label>
          <input type="text" name="system" class="form-control" value="{{ $user->system }}">
          <p class="text-warning">{{$errors->first('system')}}</p>          
            
      <hr /> 

      <button type="submit" class="btn btn-default">Edit User</button> <a href="{{url('admin')}}" class="btn btn-warning">Cancel</a>
      <hr />
  </form> 
  </div>
</div>

@stop