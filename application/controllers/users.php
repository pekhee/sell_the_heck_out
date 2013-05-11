<?php

class Users_Controller extends Base_Controller {

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
	 * View all of the users.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$users = User::with(array('todos'))->get();
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($users);
		}
		else{
			$this->layout->title   = 'Users';
			$this->layout->content = View::make('users.index')->with('users', $users);
		}
	}

	/**
	 * Show the form to create a new user.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New User';
		$this->layout->content = View::make('users.create');
	}

	/**
	 * Create a new user.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'username' => array('required'),
			'password' => array('required'),
			'email' => array('required'),
		));

		if($validation->valid())
		{
			$user = new User;

			$user->username = Input::get('username');
			$user->password = Hash::make( Input::get('password'));
			$user->email = Input::get('email');

			$user->save();

			Session::flash('message', 'Added user #'.$user->id);

			return Redirect::to('users');
		}

		else
		{
			return Redirect::to('users/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific user.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$user = User::with(array('todos'))->find($id);

		if(is_null($user))
		{
			return Redirect::to('users');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($user);
		}
		else{
			$this->layout->title   = 'Viewing User #'.$id;
			$this->layout->content = View::make('users.view')->with('user', $user);
		}
	}

	/**
	 * Show the form to edit a specific user.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$user = User::find($id);

		if(is_null($user))
		{
			return Redirect::to('users');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($user);
		}
		else{
			$this->layout->title   = 'Editing User';
			$this->layout->content = View::make('users.edit')->with('user', $user);
		}
	}

	/**
	 * Edit a specific user.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'username' => array('required'),
			'password' => array('required'),
			'email' => array('required'),
		));

		if($validation->valid())
		{
			$user = User::find($id);

			if(is_null($user))
			{
				return Redirect::to('users');
			}

			$user->username = Input::get('username');
			$user->password = Hash::make( Input::get('password'));
			$user->email = Input::get('email');

			$user->save();

			Session::flash('message', 'Updated user #'.$user->id);

			return Redirect::to('users');
		}

		else
		{
			return Redirect::to('users/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific user.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$user = User::find($id);

		if( ! is_null($user))
		{
			$user->delete();

			Session::flash('message', 'Deleted user #'.$user->id);
		}

		return Redirect::to('users');
	}
	
	/**
	 * Show login screen
	 * 
	 * @param void
	 * @return Login screen
	 */
	public function get_login(){
		Log::debug('hited login action!');
		$this->layout->title = "Login to your account";
		$this->layout->content = View::make('users.login');
	}
	
	/**
	 * Logs in user
	 * 
	 * @param 'login/username:password'
	 * or
	 * @param 'login?creds=username:password'
	 * or
	 * @param 'login?username=username,password=password'
	 * 
	 * @return Redirect to specified path in 'login?redirect_to=path'
	 * or (if redirect_to is not setted)
	 * @return Redirect to home
	 * 
	 */
	public function post_login($creds = 'default:default'){
		if(Input::get('creds', null) != null){
			$creds = Input::get('creds');
		}
		if( (Input::get('username', null) != null) && (Input::get('password', null) != null) ){
			$attempt_cred = array(
				'username' => trim( Input::get('username') ),
				'password' => trim( Input::get('password') ),
			);
		}
		else{
			$creds = explode(':',$creds);
			$attempt_cred = array(
				'username' => trim( array_get($creds, '0') ),
				'password' => trim( array_get($creds, '1') ),
			);
		}
		if(Auth::attempt($attempt_cred)){
			Session::flash('message', 'You have successfully logged in.');
			Log::debug('Logged in');
			// Redirects user to where she came from. 
			if(Input::get('alt') == 'json'){
				return Response::eloquent( Auth::user() );;
			}
			else{
				return Redirect::to(Input::get('redirect_to', '/'));
			}
		}
		else{
			// Uh oh, invalid credentials.
			Session::flash('message', 'Invalid username or password');
			Input::flash();
			if(Input::get('alt') == 'json'){
				return json_encode(array( 
				'error' => true, 
				'message' => 'Invalid username or password',
				));
			}
			else{
				$user = User::find(1);
				return Redirect::to('users/login');
			}
		}
		
	}
	
	/**
	 * Show logout screen
	 * 
	 * @param void
	 * @return Logout screen
	 */
	public function get_logout(){
		$this->layout->title = "Logout from your account";
		$this->layout->content = View::make('users.logout');
	}
	
	/**
	 * Logs out user.
	 * And returns her to path 'redirect_to=path'
	 * 
	 * @param 'redirect_to=path'
	 * 
	 * @return Redirect to path
	 * or (if redirect_to is not setted)
	 * @return Redirect to home
	 */
	public function post_logout(){
		Auth::logout();
		return Redirect::to(Input::get('redirect_to', 'home'));
	}
}