@extends('template.template')

@section('content')

<div class="col-md-6 col-md-offset-3" >
  <h1 class="text-center">Password Protected Site</h1>
</div>

<div class="col-md-6 col-md-offset-3" >
  <h4>Welcome.</h4>
  <pre>{{Session::get('source')}}</pre>
</div>

@stop