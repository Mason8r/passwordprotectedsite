<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Long Copy Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">

  </head>

  <body>

    @if(null !== Session::get('message'))
    <p class="alert alert-warning text-center">{{Session::get('message')}}</p>
    @endif

    <div class="container">

    @yield( 'content' )

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script>
      //Give a warning before deleting.
     $('.delete').click(function(event) {
    
      event.preventDefault();
    
      var deleteThis = confirm( 'are you sure you want to delete ' + this.id + '?' )     
     
      if ( deleteThis == true )
      {
       window.location.replace( this.href )
      }
     
      });
    </script>
  </body>
</html>
