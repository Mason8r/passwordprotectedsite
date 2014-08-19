@extends('template.template')

@section('content')

<?php

$dates = array(
  '<a href="'.url('order/dates/2').'" target="_blank">Saturday 1st & Sunday 2nd March</a><br />',
  '<a href="'.url('order/dates/3').'" target="_blank">Tuesday 4th & Wednesday 5th March</a><br />',
	'<a href="'.url('order/dates/2').'" target="_blank">Saturday 1st & Sunday 2nd March</a><br />',
	'<a href="'.url('order/dates/3').'" target="_blank">Tuesday 4th & Wednesday 5th March</a><br />',
	);

switch ( Session::get('datesShown') ) {
	case 0:
		$datesShown = array(2,3);
		break;
	case 1:
		$datesShown = array(2,3);
		break;
	case 2: 
		$datesShown = array(2,3);
		break;
	default:
		$datesShown = array(2,3);
		break;
}


?>

<div class="col-md-6 col-md-offset-3" >
   	<img src="{{asset('images/header.gif')}}" style="border-radius:4px 4px 0px 0px; margin: -30px 0px 15px -30px; border-bottom: 5px solid #cc0000; box-shadow: 1px 1px 5px #333;" width="765px" />
<p>The dates I have available for training are:</p>
    <p style="text-align: center;"><span class="kp red">
    	<?php
			
			foreach($datesShown as $date) {
				echo $dates[$date];
			}

    	?>
    </span></p>
		</div>
@stop