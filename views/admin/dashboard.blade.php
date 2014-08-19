@extends('admin.layout')

@section('content')

<div class="row">     
  <div class="col-md-12">
    <h1 class="text-center">Administration - Affiliates and Users</h1>
  </div>
</div>
<div class="row">     
  <div class="col-md-12">
      <div class="col-md-4 col-md-offset-2">
        <h3>Add/Remove Affiliates</h3>
        <a href="{{url('admin/create-aff')}}" class="btn btn-default" >Add New Affiliate</a>
        <hr />
        <h4>Current Affiliates</h4> 
        <h5>Active</h5>
          <ul>
          @foreach($affiliates as $affiliate)
          @unless($affiliate->status == 0)
            <li>{{$affiliate->name}} ({{$affiliate->url}}) | 
              <a href="{{url('admin/delete-aff',$affiliate->id)}}" class="delete" id="{{$affiliate->name}}">
                <i class="fa fa-times"></i></a> | 
              <a href="{{url('admin/edit-aff',$affiliate->id)}}" >
                <i class="fa fa-pencil-square-o"></i></a> | Hits: {{Tracking::where('source','=',$affiliate->url)->count()}}
            </li>
          @endunless

          @endforeach 
          </ul> 
          <hr />
          <h5>Inactive</h5>
          <ul>
          @foreach($affiliates as $affiliate)
          @unless($affiliate->status == 1)
            <li>{{$affiliate->name}} ({{$affiliate->url}}) | 
              <a href="{{url('admin/activate-aff',$affiliate->id)}}" class="activate" id="{{$affiliate->name}}">
                <i class="fa fa-check"></i></a> | 
              <a href="{{url('admin/edit-aff',$affiliate->id)}}" >
                <i class="fa fa-pencil-square-o"></i></a>  | Hits: {{Tracking::where('source','=',$affiliate->url)->count()}}
            </li>
          @endunless
          @endforeach 
          </ul> 
          <hr />        
      </div> 
     <div class="col-md-4">
        <h3>Add/Remove/Find User</h3>
        <a href="{{url('admin/create-user')}}" class="btn btn-default" >Add New User</a>
        <hr />
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
</div> 

@stop

@section('script')
<script type="text/javascript">
$('.delete').click(function(event) {
    
    event.preventDefault();
    
    var deleteThis = confirm( 'are you sure you want to delete ' + this.id + '?' )     
     
    if ( deleteThis == true )
    {
      window.location.replace( this.href )
    }
     
});
</script>
@stop