@extends('admin.layout')

@section('content')

    <div class="row">
      <div class="col-md-12">
        <h3>Create New User</h3>
          <form role="form" method="post" action="{{url( 'admin/create-user/' )}}">
            <div class="form-group">
              <label for="first_name">First Name:</label><br />
              <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{Input::old('first_name')}}">
              {{$errors->first('first_name')}}
            </div>
            <div class="form-group">
              <label for="last_name">Last Name:</label><br />
              <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{Input::old('last_name')}}">
              {{$errors->first('last_name')}}
            </div>
            <div class="form-group">
              <label for="email">Email:</label><br />
              <input type="email" class="form-control" name="email" placeholder="Email" value="{{Input::old('email')}}">
              {{$errors->first('email')}}
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="send" > Tick this box if you would like to email this user with their new Passcode.
              </label>
            </div>
      <input type="submit" value="submit" class="btn btn-block btn-primary" />
    </form>             
      </div>        
    </div>
@stop