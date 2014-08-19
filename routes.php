<?php

/*
|--------------------------------------------------------------------------
| Once offer is over, uncomment this...
|--------------------------------------------------------------------------
|
| Add and Remove Affiliates, Users etc...
|
Route::get('/{any?}', function() { 

	return View::make('over');

});
*/

/*
|--------------------------------------------------------------------------
| Admin Controller
|--------------------------------------------------------------------------
|
| Add and Remove Affiliates, Users etc...
|
*/
Route::controller('admin','AdminController');


/*
|--------------------------------------------------------------------------
| Logged in
|--------------------------------------------------------------------------
|
| They can only get here if we have all of their data
| of if their passcode checks out. 
| 
*/
Route::get('/', function() { 

	if( ! Session::has('accepted') ) {
		
		return View::make('direct');
	
	}

	//Do all the stuff you need to here to make Sales Copy 
	return View::make('salescopy');

});

/*
|--------------------------------------------------------------------------
| Direct Access (Mailout)
|--------------------------------------------------------------------------
| Steps from here:
| . Ask them to enter there reg code
| . Check reg-code 
| . Take a note of when they accessed the page
|
*/
/*Something wrong with L4.1.18*/
Route::get('direct', function() {
	
	return View::make('direct');	

});

Route::post('direct', function() {

	Input::flash();

	$data = Input::all();

	$rules = array(
		
		'passcode' => 'min:9|max:9|required|alpha_num|exists:reg_codes,reg_code'
		
	);

	$validation = Validator::make( $data , $rules );
	
	if( $validation->fails() ) {

		//Need let them win if they came close enough...
      	$codebits[0] = substr($data['passcode'],0,2);
      	$codebits[1] = substr($data['passcode'],2,5);
      	$codebits[2] = substr($data['passcode'],7,2);
      	
      	for ($i=0;$i<3;$i++) {
        
        	$testcode = $codebits[$i];
        	$outcode = "";
        
	        for ($j=0;$j<strlen($testcode);$j++) {
          		if  ($i==1) {

		            if (substr($testcode,$j,1)=='i') {
              		$outcode .= "1";
            		} else if (substr($testcode,$j,1)=='l') {
              		$outcode .= "1";
            		} else if (substr($testcode,$j,1)=='o') {
              		$outcode .= "0";
            		} else if (substr($testcode,$j,1)=='s') {
              		$outcode .= "5";
            		} else {
              		$outcode .= substr($testcode,$j,1);
            		}

          		} else {
          			
		            if (substr($testcode,$j,1)=='1') {
              		$outcode .= "l";
            		} else if (substr($testcode,$j,1)=='0') {
              		$outcode .= "o";
            		} else if (substr($testcode,$j,1)=='8') {
              		$outcode .= "b";
            		} else if (substr($testcode,$j,1)=='5') {
            	  	$outcode .= "s";
            		} else {
              		$outcode .= substr($testcode,$j,1);
            		}
          		}
        	}
        
        	$codebits[$i] = $outcode;
      	}

    	$data['passcode'] = $codebits[0] . $codebits[1] . $codebits[2];

    	$secondtry = Validator::make( $data , $rules );

    	if ($secondtry->fails()) {

			$access = new Tracking;
			$access->reg_codes_id 	= 0;
			$access->type 			= 'wrongreg';
			$access->source 		= $data['passcode'];
			$access->save();

			return Redirect::to('direct')->withErrors($validation)->withInput();
		}

	} 

	//we know the passcode exists otherwise they would have been thrown
	//back into the login page. Get the passcode, put it in the tracker,
	//do a little dance. 
	$user = Regcode::where( 'reg_code' , '=' , $data['passcode'] )->first();

	$access = new Tracking;
	$access->reg_codes_id 	= $user->id;
	$access->type 			= 'mailout';
	$access->source 		= 'direct';
	$access->save();

	Session::put( 'accepted' , true );
	Session::put( 'datesShown' , $user->date_number );

	return Redirect::to('/');

});

/*
|--------------------------------------------------------------------------
| Email/External Link access
|--------------------------------------------------------------------------
| Steps from here:
| . Take all of their details
| . Take a note of when they accessed the page
|
*/
Route::get('int/{source?}', function($source = 'none')
{
	Session::put( 'source' , $source );

	return View::make('signup')->withSource($source);

});

Route::post('int/{source}', function($source)
{
	
	Input::flash();

	$data = Input::all();

	$rules = array(
		'first_name'=> 'required|min:2',
		'last_name' => 'required|min:2|',
		'email' 	=> 'required|email',
	);

	$validation = Validator::make($data,$rules);

	if($validation->fails()) {
		return Redirect::to( 'int/' . $source )->withErrors($validation);
	}

	$data['passcode'] = Passcode::create();

	$user = new Regcode;
	$user->first_name = $data['first_name'];
	$user->last_name = $data['last_name'];
	$user->email = $data['email'];
	$user->reg_code = $data['passcode'];
	$user->source = $source;
	$user->system = 'link';
	$user->save();

	//Email the user their new passcode
	Mail::send('emails.passcode', $data , function($message)
	{
	    $message->from('admin@waverleymedia.com', 'Admin');
    	$message->to(Input::get('email'));
    	$message->subject('Password Request');
	});

	//Track'em
	$access = new Tracking;
	$access->reg_codes_id 	= $user->id;
	$access->type 			= 'int';
	$access->source 		= $source;
	$access->save();

	Session::put( 'source' , $source );
	Session::put( 'accepted' , true );
	Session::put( 'datesShown' , $user->date_number );

	return Redirect::to('/');	
	
});

/*
|--------------------------------------------------------------------------
| Affiliate Link Access
|--------------------------------------------------------------------------
| Steps from here:
| . These puppies get direct access to the salespage, the source is kept.
| . Ther is a list of safe sources for entries sake. Obv.
|
*/
Route::get('aff/{source?}', function($source = 'none')
{
	
	$affiliates = Affiliate::where('status','=',1)->get();
	
	$safe_sources = array();

	foreach ($affiliates as $affiliate) {
		
		$safe_sources[] = $affiliate->url;

	}

	if(!in_array( $source, $safe_sources )) {
		
		return Redirect::to('int/wrongafflink');
	
	}

	$access = new Tracking;
	$access->reg_codes_id 	= 0;
	$access->type 			= 'affiliate';
	$access->source 		= $source;
	$access->save();
		
	Session::put( 'source' , $source );
	Session::put( 'accepted' , true );
	Session::put( 'datesShown' , 0 );

	return Redirect::to('/');
	
});


/*
|--------------------------------------------------------------------------
| Order Date Stuff
|--------------------------------------------------------------------------
|
*/
Route::get('order/dates/{selection?}' , function ($selection = false) {

	$order = 'https://www.markiteer-secure.com/order/form.php?pid=tpd-02569-f';

	$dates = array(
		'https://www.markiteer-secure.com/order/form.php?pid=tpd-02569-f',
		'https://www.markiteer-secure.com/order/form.php?pid=tpd-02569-f2',
		'https://www.markiteer-secure.com/order/form.php?pid=tpd-02569-m',
		'https://www.markiteer-secure.com/order/form.php?pid=tpd-02569-m2',
	);

	if( is_numeric( $selection ) ) {
		return Redirect::away($dates[$selection]);
	}

	return View::make('orderdates');

});


/*
|--------------------------------------------------------------------------
| Admin Shite
|--------------------------------------------------------------------------
|
*/
Route::get('login', function () {

	return View::make('login');

});

Route::post('login', function () {

	if ( ! Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
	{
	    return Redirect::to('login');
	}

	return Redirect::to('admin');

});

//theres a fuck load of logic with Admin, stick it in a controller...
Route::controller('admin', 'AdminController');

/*
|--------------------------------------------------------------------------
| Catch all & Testing stuff
|--------------------------------------------------------------------------
| obfuscate cos....
|
*/
Route::get('createadmin46hfghdioud4hdgfiuyg', function() {
	
	$user = new Admin;
	$user->email = 'technical@waverleymedia.com';
	$user->password = Hash::make('secret');
	$user->save();

});

Route::get('destroy', function() {
	
	Session::flush();

	return Redirect::to('/');

});



Route::get('/{source?}',function($source) {

	return Redirect::to('int/catchall/');

});


