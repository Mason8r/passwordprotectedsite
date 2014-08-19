@extends('admin.layout')

@section('content')
<div class="row">     
  <div class="col-md-12">
    <h1 class="text-center">Find, Edit and Delete Users</h1>
     <h4>Find User (you can edit or delete the user from there.)</h4> 
        <form role="form" action="{{url('admin/find-user')}}" method="post">
            <label for="name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="name" placeholder="First Name" value="{{ Input::old('first_name' )}}">
            <label for="name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="name" placeholder="Surname" value="{{ Input::old('last_name' )}}">
            <label for="name">Postcode</label>
            <input type="text" name="postcode" class="form-control" id="postcode" placeholder="Post Code" value="{{ Input::old('postcode' )}}">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="{{ Input::old('email')}}">
            <br /> 
            <button type="submit" class="btn btn-default">Find User</button>
        </form> 
  </div>
</div>
@if(isset($users))
<div class="row">     
      <div class="col-md-3 col-md-offset-1">

        <h3>Search Results</h3> 
        <ul class="list-unstyled">
          @foreach($users as $user)
            <li><h4>{{$user->first_name}} {{$user->last_name}}</h4>
            <pre>{{$user->reg_code}}</pre>
            Postcode: {{$user->postcode}} | Email: {{$user->email}}<br />
             <a href="{{url('admin/delete-user',$user->id)}}" class="delete" id="{{$user->id}}">
                Delete User <i class="fa fa-times"></i></a> | 
              <a href="{{url('admin/edit-user',$user->id)}}" >
                Edit User <i class="fa fa-pencil-square-o"></i></a>
            </li>
          @endforeach 
      </ul>
  </div>
</div>
@endif
@stop