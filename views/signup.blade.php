@extends('template.template')

@section('content')

<div class="col-md-6 col-md-offset-3" >
  <h2>Password Protected Site</h2>
        <p>Enter your details below to gain access:</p>
          <form role="form" method="post" action="{{url( 'int/' . Session::get('source') )}}">
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
      <input type="submit" value="submit" class="btn btn-block btn-primary" />
    </form>
</div>
<div class="col-md-6 col-md-offset-3" >
  <h4>Terms of Use</h4>
  <p>The information provided on this site is confidential and intended to be viewed only by a person or organisation to whom a password has been issued and any person or organisation they authorise to offer opinion or advice to them personally. We do not authorise any other person to read, copy or use it, nor publish or otherwise put into the public domain any part of this information in any format.</p>
</div>
@stop
