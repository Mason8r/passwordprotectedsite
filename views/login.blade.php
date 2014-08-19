@extends('template.template')

@section('content')
        <div class="login-form col-md-6 col-md-offset-3">
          <h1 class="text-center">Administration Login</h1>
          @if($errors->has('password'))
            <p>{{$errors->first('password')}}. Please try again.</p>
          @endif
          @if(Input::old('password'))
            <p>The passcode you entered was: <h2>{{Input::old('password')}}</h2></p>
          @endif
          <form role="form" method="post" action="{{url('login')}}">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <input type="submit" value="submit" class="btn btn-default btn-block btn-success" />
          </form>
        </div>
@stop

