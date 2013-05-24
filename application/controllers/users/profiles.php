<?php

class Users_Profiles_Controller extends Base_Controller {

	/**
	 * The layout being used by the controller.
	 *
	 * @var string
	 */
	public $layout = 'layouts.scaffold';

	/**
	 * Indicates if the controller uses RESTful routing.
	 *
	 * @var bool
	 */
	public $restful = true;

	/**
	 * View all of the profiles.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$profiles = User_Profile::with(array('user'))->get();
		if(Input::get('alt') == 'json'){
			return Response::eloquent($profiles);
		}
		else{
			$this->layout->title   = 'Users Profiles';
			$this->layout->content = View::make('users.profiles.index')->with('profiles', $profiles);
		}
	}

	/**
	 * Show the form to create a new profile.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
		if(Auth::user()->profile != null){
			return Redirect::to_route('users.profile.edit', array( 'user_id' => $user_id ));
		}
		$this->layout->title   = 'New Users Profile';
		$this->layout->content = View::make('users.profiles.create')->with('user_id', $user_id);
	}

	/**
	 * Create a new profile.
	 *
	 * @return Response
	 */
	public function post_create($user_id = 0)
	{
		$validation = Validator::make(Input::all(), array(
			'first_name' => array('required'),
			'last_name' => array('required'),
			'phone' => array('required'),
			'place' => array('required'),
			'map' => array('required'),
			'city' => array('required'),
			'country' => array('required'),
			'time_zone' => array('required'),
		));

		if($validation->valid())
		{
			if(Auth::user()->profile != null){
				return Redirect::to_route('users.profile.edit', array( 'user_id' => $user_id ));
			}
			$profile = new User_Profile;

			$profile->user_id = $user_id;
			$profile->first_name = Input::get('first_name');
			$profile->last_name = Input::get('last_name');
			$profile->phone = Input::get('phone');
			$profile->place = Input::get('place');
			$profile->map = Input::get('map');
			$profile->city = Input::get('city');
			$profile->country = Input::get('country');
			$profile->time_zone = Input::get('time_zone');
			$profile->save();
			if( array_get(Input::file('pic'), 'size', 0) != 0 ){
				Log::debug('has pic');
				Input::upload('pic', path('storage') . 'work/' . 'image/', $profile->id . '.jpg');
				$profile->pic_link = path('storage') . 'work/' . 'image/' . "$profile->id" . '.jpg';
				$profile->save();
			}

			Session::flash('message', 'Added profile #'.$profile->id);

			return Redirect::to('users/profiles');
		}

		else
		{
			return Redirect::to('users/profiles/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific profile.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($user_id = 0)
	{
		$profile = User::with(array('profile'))->find($user_id)->profile()->first();

		if(Input::get('alt') == 'json'){
			return Response::eloquent($profiles);
		}

		if(is_null($profile))
		{
			return Redirect::to_route('users.profile.new', array( 'user_id' => $user_id ));
		}
		
		else{
			$this->layout->title   = 'Viewing Users Profile #'.$user_id;
			$this->layout->content = View::make('users.profiles.view')->with('profile', $profile);
		}
	}

	/**
	 * Show the form to edit a specific profile.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($user_id = 0)
	{
		$profile = User::find($user_id)->with('profile')->profile;

		if(is_null($profile))
		{
			return Redirect::to_route('users.profile.new', array( 'user_id' => $user_id ));
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($profiles);
		}
		else{
			$this->layout->title   = 'Editing Users Profile';
			$this->layout->content = View::make('users.profiles.edit')->with( array('profile' => $profile, 'user_id' => $user_id ));
		}
	}

	/**
	 * Edit a specific profile.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function put_edit($user_id)
	{
		$validation = Validator::make(Input::all(), array(
			'first_name' => array('required'),
			'last_name' => array('required'),
			'phone' => array('required'),
			'place' => array('required'),
			'map' => array('required'),
			'city' => array('required'),
			'country' => array('required'),
			'time_zone' => array('required'),
		));

		if($validation->valid())
		{
			$profile = User::find($user_id)->with('profile')->profile;

			if(is_null($profile))
			{
				return Redirect::to_route('users.profile.new');
			}

			$profile->user_id = Auth::user()->id;
			$profile->first_name = Input::get('first_name');
			$profile->last_name = Input::get('last_name');
			$profile->phone = Input::get('phone');
			$profile->place = Input::get('place');
			$profile->map = Input::get('map');
			$profile->city = Input::get('city');
			$profile->country = Input::get('country');
			$profile->time_zone = Input::get('time_zone');
			$profile->save();
			if( array_get(Input::file('pic'), 'size', 0) != 0 ){
				Log::debug('has pic');
				Input::upload('pic', path('public') . 'user_data/' . 'image/', $profile->id . '.jpg');
				$profile->pic_link = '/public/' . 'user_data/' . 'image/' . "$profile->id" . '.jpg';
				$profile->save();
			}

			Session::flash('message', 'Updated profile #'.$profile->id);

			return Redirect::to_route('users.profile.view', array( 'user_id' => $user_id ));
		}

		else
		{
			return Redirect::to_route('users.profile.edit', array( 'user_id' => $user_id ))
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific profile.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($user_id)
	{
		$profile = User::find($user_id)->with('profile')->profile;

		if( ! is_null($profile))
		{
			$profile->delete();
			Session::flash('message', 'Deleted profile #'.$profile->id);
		}

		return Redirect::to_route('users.view', array( 'user_id' => $user_id ));
	}
}