<?php

class Ads_Controller extends Base_Controller {

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
	 * This method executes before any other method is called.
	 * 
	 */
	public function before(){
		
	}

	/**
	 * View all of the ads.
	 *
	 * @return void
	 */
	public function get_index($user_id = 0)
	{
		if($user_id == 0){
			$user_id = object_get(Auth::user(), 'id', 0);
		}
		
		$ads = Ad::with(array('user', 'comments', 'categories'))->where( 'user_id', '=', $user_id )->get();
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($ads);
		}
		else{
			$this->layout->title   = 'ads';
			$this->layout->content = View::make('ads.index')->with('ads', $ads);
		}
	}

	/**
	 * Show the form to create a new ad.
	 *
	 * @return void
	 */
	public function get_create($user_id = 0)
	{
		if($user_id == 0){
			$user_id = object_get(Auth::user(), 'id', 0);
		}
		
		$user = User::find($user_id);
		$this->layout->title   = 'New Ad';
		$this->layout->content = View::make('ads.create', array(
									'user_id' => $user_id,
									'user' => $user,
								));
	}

	/**
	 * Create a new ad.
	 *
	 * @return Response
	 */
	public function post_create($user_id = 0)
	{
		Log::debug( 'Args to pcreate: ' . '1:'.$user_id);
		if($user_id == 0){
			$user_id = object_get(Auth::user(), 'id', 0);
		}
		
		$validation = Validator::make(Input::all(), array(
			'good_id' 		=> array('required'),
			'good_type' 	=> array('required'),
			'category_ids'	=> array('required'),

			'title' 		=> array('required'),
			'img_links' 	=> array('required'),
			'description' 	=> array('required'),
			'price' 		=> array('required'),
			'num_visits' 	=> array('required'),
			'promotions' 	=> array('required'),
			'price_type' 	=> array('required'),
			'offer_type' 	=> array('required'),
			'seller_type' 	=> array('required'),
		));

		if($validation->valid())
		{
			$ad = new Ad;
			$user = User::find($user_id);
			$category_ids = AppHelper::explode_and_trim(Input::get('category_ids'), ':');
			foreach( $category_ids as $category_id){
				$cat = Category::find($category_id);
				AppHelper::insert_if_exists($ad, $cat, 'categories');
			}
			
			$ad->user_id 		  = object_get($user, 'id', null, true);
			$ad->good_id 		  = Input::get('good_id');
			$ad->good_type 	 	  = Input::get('good_type');
			$ad->title 		 	  = Input::get('title');
			$ad->img_links 	 	  = Input::get('img_links');
			$ad->description 	  = Input::get('description');
			$ad->price 		 	  = Input::get('price');
			$ad->num_visits  	  = Input::get('num_visits');
			$ad->promotions  	  = Input::get('promotions');
			$ad->price_type  	  = Input::get('price_type');
			$ad->offer_type  	  = Input::get('offer_type');
			$ad->seller_type 	  = Input::get('seller_type');

			$ad->save();

			Session::flash('message', 'Added ad #'.$ad->id);

			return Redirect::to_route('users.ads');
		}

		else
		{
			return Redirect::to_route('users.ads.create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific ad.
	 *
	 * @param  int   $ad_id
	 * @return void
	 */
	public function get_view($user_id = 0, $ad_id = 0)
	{
		if($user_id == 0){
			$user_id = Auth::user()->id;
		}
		$user = User::find($user_id);
		
		$ad = Ad::with(array('user', 'comments', 'categories'))->find($ad_id);

		if(is_null($ad))
		{
			return Redirect::to_route('users.ads');
		}
		
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($ad);
		}
		else{
			$this->layout->title   = 'Viewing ad #'.$ad_id;
			$this->layout->content = View::make('ads.view')->with(array('ad' => $ad, 'user' => $user));
		}
	}

	/**
	 * Show the form to edit a specific ad.
	 *
	 * @param  int   $ad_id
	 * @return void
	 */
	public function get_edit($user_id = 0, $ad_id = 0)
	{
		if($user_id == 0){
			$user_id = Auth::user()->id;
		}
		$user = User::find($user_id);
		
		$ad = Ad::find($ad_id);

		if(is_null($ad))
		{
			return Redirect::to_route('users.ads');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($ad);
		}
		else{
			$this->layout->title   = 'Editing Ad';
			$this->layout->content = View::make('ads.edit')->with('ad', $ad);
		}
	}

	/**
	 * Edit a specific ad.
	 *
	 * @param  int       $ad_id
	 * @return Response
	 */
	public function put_edit($user_id = 0, $ad_id = 0)
	{
		if($user_id == 0){
			$user_id = Auth::user()->id;
		}
		$user = User::find($user_id);
		
		$validation = Validator::make(Input::all(), array(
			'good_id' 		=> array('required'),
			'good_type' 	=> array('required'),
			'category_ids'	=> array('required'),

			'title' 		=> array('required'),
			'img_links' 	=> array('required'),
			'description' 	=> array('required'),
			'price' 		=> array('required'),
			'num_visits' 	=> array('required'),
			'promotions' 	=> array('required'),
			'price_type' 	=> array('required'),
			'offer_type' 	=> array('required'),
			'seller_type' 	=> array('required'),
		));

		if($validation->valid())
		{
			$ad = Ad::find($ad_id);

			if(is_null($ad))
			{
				return Redirect::to('ads');
			}
			
			$category_ids = AppHelper::explode_and_trim(Input::get('category_ids'));
			foreach( $category_ids as $category_id){
				$cat = Category::find($category_id);
				AppHelper::insert_if_exists($ad, $cat, 'categories');
			}

			$ad->user_id 		  = Auth::user()->id;
			$ad->good_id 		  = Input::get('good_id', 		$ad->good_id);
			$ad->good_type 	 	  = Input::get('good_type', 	$ad->good_type);
			$ad->title 		 	  = Input::get('title', 		$ad->title);
			$ad->img_links 	 	  = Input::get('img_links', 	$ad->img_links);
			$ad->description 	  = Input::get('description', 	$ad->description);
			$ad->price 		 	  = Input::get('price', 		$ad->price);
			$ad->num_visits  	  = Input::get('num_visits', 	$ad->num_visits);
			$ad->promotions  	  = Input::get('promotions', 	$ad->promotions);
			$ad->price_type  	  = Input::get('price_type', 	$ad->price_type);
			$ad->offer_type  	  = Input::get('offer_type', 	$ad->offer_type);
			$ad->seller_type 	  = Input::get('seller_type', 	$ad->seller_type);

			$ad->save();

			Session::flash('message', 'Updated ad #'.$ad->id);

			return Redirect::to('ads');
		}

		else
		{
			return Redirect::to_route('users.ads.edit', array( 'user_id' =>  $user_id, 'ad_id' => $ad_id))
					->with_errors($validation->errors)
					->with_input();
		}
	}

	// TODO: get_delete | to return a delete form

	/**
	 * Delete a specific ad.
	 *
	 * @param  int       $user_id
	 * @param  int       $ad_id
	 * @return Response
	 */
	public function delete_delete($user_id = 0, $ad_id = 0)
	{
		if($user_id == 0){
			$user_id = Auth::user()->id;
		}
		
		$ad = Ad::find($ad_id);
		$user = User::find($user_id);

		if( ! is_null($ad))
		{
			$ad->delete();

			Session::flash('message', 'Deleted ad #'.$ad->id);
		}

		return Redirect::to('ads');
	}
}