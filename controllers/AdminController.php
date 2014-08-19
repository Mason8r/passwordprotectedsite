<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Admin Controller
	|--------------------------------------------------------------------------
	|
	*/
	public function __construct()
    {
        $this->beforeFilter('auth');
    }

	public function getIndex()
	{
		
		$data['affiliates'] = Affiliate::all();
		
		return View::make( 'admin.dashboard' , $data );
	}

	/*
	|--------------------------------------------------------------------------
	| Affiliate Stuff - Edit
	|--------------------------------------------------------------------------
	|
	*/
	public function getEditAff($id)
	{
		
		$data['affiliate'] = Affiliate::find($id);
		
		return View::make( 'admin.aff.edit' , $data );
	}

	public function postEditAff($id)
	{
		
		Input::flash();

		$data = Input::all();

		$rules = array(

			);

		$validation = Validator::make($data,$rules);

		if($validation->fails()) {

			return Redirect::route('editAff')->withErrors($validation);
		
		}
		
		$affiliate = Affiliate::find($id);
		$affiliate->name = $data['name'];
		$affiliate->url = $data['url'];
		$affiliate->save();

		return Redirect::to( 'admin' )->withMessage('Affiliate successfully edited');
	}


	/*
	|--------------------------------------------------------------------------
	| Affiliate Stuff - Create
	|--------------------------------------------------------------------------
	|
	*/
	public function getCreateAff()
	{
		
		return View::make( 'admin.aff.create' );
	}

	public function postCreateAff()
	{
		
		Input::flash();

		$data = Input::all();

		$rules = array(

			);

		$validation = Validator::make($data,$rules);

		if($validation->fails()) {

			return Redirect::route('createAff')->withErrors($validation);
		
		}

		$affiliate = new Affiliate;
		$affiliate->name = $data['name'];
		$affiliate->url = $data['url'];
		$affiliate->status = 1;
		$affiliate->save();
		
		return Redirect::to( 'admin' );
	}

	/*
	|--------------------------------------------------------------------------
	| Affiliate Stuff - Delete/Activate
	|--------------------------------------------------------------------------
	|
	*/
	public function getDeleteAff($id)
	{
		
		$affiliate = Affiliate::find($id);
		$affiliate->status = 0;
		$affiliate->save();

		return Redirect::to( 'admin' )->withMessage('Affiliate '.$affiliate->name.' successfully deleted.');
	}
	
	public function getActivateAff($id)
	{
		
		$affiliate = Affiliate::find($id);
		$affiliate->status = 1;
		$affiliate->save();

		return Redirect::to( 'admin' )->withMessage('Affiliate '.$affiliate->name.' successfully re-activated.');
	}


	/*
	|--------------------------------------------------------------------------
	| User Stuff - Create
	|--------------------------------------------------------------------------
	|
	*/
	public function getCreateUser()
	{
		
		return View::make( 'admin.user.create' );
	}

	public function postCreateUser()
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
			
			return Redirect::to( 'admin/create-user' )->withErrors($validation);
		
		}

		$data['passcode'] = Passcode::create();

		$user = new Regcode;
		$user->first_name = $data['first_name'];
		$user->last_name = $data['last_name'];
		$user->email = $data['email'];
		$user->reg_code = $data['passcode'];
		$user->source = 'admin';
		$user->system = 'admin';
		$user->save();

		if(Input::get('send')) {

			//Email the user their new passcode
			Mail::send('emails.passcode', $data , function($message)
			{
			    $message->from('admin@waverleymedia.com', 'Admin');
		    	$message->to(Input::get('email'));
		    	$message->subject('Password Request');
			});

		}

		//Track'em
		$access = new Tracking;
		$access->reg_codes_id 	= $user->id;
		$access->type 			= 'admincreated';
		$access->source 		= 'admincreated';
		$access->save();

		return Redirect::to('admin')->withMessage('User Added! Passcode: '.$data['passcode']);	
	}

	/*
	|--------------------------------------------------------------------------
	| User Stuff - Find
	|--------------------------------------------------------------------------
	|
	*/
	public function getFindUser()
	{
		
		return View::make( 'admin.user.find' );
	}

	public function postFindUser()
	{
		Input::flash();

		$data = Input::all();

 		$query = DB::table('reg_codes');

		if ($data['email'] != '') {
		    $query->where('email', '=', $data['email']);
		}

		if ($data['first_name'] != '') {
		    $query->where('first_name', '=', $data['first_name']);
		}

		if ($data['postcode'] != '') {
		    $query->where('postcode', '=', $data['postcode']);
		}

		if ($data['last_name'] != '') {
		    $query->where('last_name', '=', $data['last_name']);
		}

		$data['users'] = $query->get();

		return View::make( 'admin.user.find' , $data );	
	}

	public function getDeleteUser($id)
	{
		
		$user = Regcode::find($id);
		$user->delete();

		return Redirect::to('admin' )->withMessage('User '.$user->name.' successfully deleted.');
	}

	public function getEditUser($id)
	{
		
		$data['user'] = Regcode::find($id);
		
		return View::make( 'admin.user.edit' , $data );
	}

	public function postEditUser($id)
	{
		
		Input::flash();

		$data = Input::all();

		dd($data);

		$rules = array(

			);

		$validation = Validator::make($data,$rules);

		if($validation->fails()) {

			return Redirect::route('editAff')->withErrors($validation);
		
		}
		
		$affiliate = Affiliate::find($id);
		$affiliate->name = $data['name'];
		$affiliate->url = $data['url'];
		$affiliate->save();

		return Redirect::to( 'admin' )->withMessage('Affiliate successfully edited');
	}




}