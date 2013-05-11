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
		$this->layout->title   = 'New Users Profile';
		$this->layout->content = View::make('users.profiles.create');
	}

	/**
	 * Create a new profile.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'last_name' => array('required'),
			'city' => array('required'),
			'country' => array('required'),
			'time_zone' => array('required'),
		));

		if($validation->valid())
		{
			$profile = new User_Profile;

			$profile->user_id = Auth::user()->id;
			$profile->name = Input::get('name');
			$profile->last_name = Input::get('last_name');
			$profile->city = Input::get('city');
			$profile->country = Input::get('country');
			$profile->time_zone = Input::get('time_zone');
			$profile->save();
			if(!is_null(Input::file('pic'))){
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
	public function get_view($id)
	{
		$profile = User_Profile::with(array('user'))->find($id);

		if(is_null($profile))
		{
			return Redirect::to('users/profiles');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($profiles);
		}
		else{
			$this->layout->title   = 'Viewing Users Profile #'.$id;
			$this->layout->content = View::make('users.profiles.view')->with('profile', $profile);
		}
	}

	/**
	 * Show the form to edit a specific profile.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$profile = User_Profile::find($id);

		if(is_null($profile))
		{
			return Redirect::to('users/profiles');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($profiles);
		}
		else{
			$this->layout->title   = 'Editing Users Profile';
			$this->layout->content = View::make('users.profiles.edit')->with('profile', $profile);
		}
	}

	/**
	 * Edit a specific profile.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'last_name' => array('required'),
			'city' => array('required'),
			'country' => array('required'),
			'time_zone' => array('required'),
		));

		if($validation->valid())
		{
			$profile = User_Profile::find($id);

			if(is_null($profile))
			{
				return Redirect::to('users/profiles');
			}

			$profile->user_id = Auth::user()->id;
			$profile->name = Input::get('name');
			$profile->last_name = Input::get('last_name');
			$profile->city = Input::get('city');
			$profile->country = Input::get('country');
			$profile->time_zone = Input::get('time_zone');
			$profile->save();
			if(!is_null(Input::file('pic'))){
				Log::debug('has pic');
				Input::upload('pic', path('public') . 'user_data/' . 'image/', $profile->id . '.jpg');
				$profile->pic_link = '/public/' . 'user_data/' . 'image/' . "$profile->id" . '.jpg';
				$profile->save();
			}

			Session::flash('message', 'Updated profile #'.$profile->id);

			return Redirect::to('users/profiles');
		}

		else
		{
			return Redirect::to('users/profiles/edit/'.$id)
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
	public function get_delete($id)
	{
		$profile = User_Profile::find($id);

		if( ! is_null($profile))
		{
			$profile->delete();

			Session::flash('message', 'Deleted profile #'.$profile->id);
		}

		return Redirect::to('users/profiles');
	}
}