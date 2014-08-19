@extends('template.template')

@section('content')

<div class="col-md-6 col-md-offset-3" >
  <h1>Password Protected Page</h1>
  <form role="form" method="post" action="{{url('direct')}}">
    <div class="form-group">
      <label for="passcode"></label>
      <p id='label'>Enter Passcode:</p>
      <input type="password" class="form-control" id='input' name="passcode" placeholder="Passcode">
      <br />
      <input type="submit" class="btn btn-primary btn-large btn-block" >
    </div>
  </form>
  @if($errors->has('passcode'))
    <div style="border: 1px solid #FF9900; padding: 10px; margin: 
      20px auto; background-color: #FFFF66; color: #000;">
      <p>{{$errors->first('passcode')}}</p>
      <p>Please try again. The passcode you entered:</p>
      <pre style="font-size:50px;">{{Input::old('passcode')}}</pre>
    </div>
  @endif
</div>

<div class="col-md-6 col-md-offset-3" >
  <h4>Terms of Use</h4>
  <p>The information provided on this site is confidential and intended to be viewed only by a person or organisation to whom a password has been issued and any person or organisation they authorise to offer opinion or advice to them personally. We do not authorise any other person to read, copy or use it, nor publish or otherwise put into the public domain any part of this information in any format.</p>
</div>
@stop