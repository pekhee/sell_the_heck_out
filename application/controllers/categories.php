<?php

class Categories_Controller extends Base_Controller {

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
	 * View all of the categories.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$categories = Category::with(array('user', 'ads'))->get();

		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Categories';
			$this->layout->content = View::make('categories.index')->with(
				array(
					'categories' => $categories,
				));
		}
	}

	/**
	 * Show the form to create a new category.
	 *
	 * @return void
	 */
	public function get_create()
	{
		$this->layout->title   = 'New Ad Category';
		$this->layout->content = View::make('categories.create', array(
									
								));
	}

	/**
	 * Create a new category.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'description' => array('required'),
			'parent_id' => array('required'),
		));

		if($validation->valid())
		{
			$category = new Category;
			$category->user_id = object_get(Auth::user(), 'id', null);
			$category->parent_id = Input::get('parent_id');
			$category->name = Input::get('name');
			$category->description = Input::get('description');

			$category->save();

			Session::flash('message', 'Added category #'.$category->id);

			return Redirect::to_route('users.categories');
		}

		else
		{
			return Redirect::to_route('users.categories.new')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific category.
	 *
	 * @param  int   $category_id
	 * @return void
	 */
	public function get_view($category_id)
	{
		$category = Category::with(array('user', 'ads'))->find($category_id);
		if(is_null($category))
		{
			return Redirect::to_route('users.categories');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Viewing Ad Category #'.$category_id;
			$this->layout->content = View::make('categories.view')->with('category', $category);
		}
	}

	/**
	 * Show the form to edit a specific category.
	 *
	 * @param  int   $category_id
	 * @return void
	 */
	public function get_edit($category_id)
	{
		$category = Category::find($category_id);

		if(is_null($category))
		{
			return Redirect::to_route('users.categories');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Editing Ad Category';
			$this->layout->content = View::make('categories.edit')->with('category', $category);
		}
	}

	/**
	 * Edit a specific category.
	 *
	 * @param  int       $category_id
	 * @return Response
	 */
	public function post_edit($category_id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'description' => array('required'),
			'parent_id' => array('reuired'),
		));

		if($validation->valid())
		{
			$category = Category::find($category_id);

			if(is_null($category))
			{
				return Redirect::to_route('users.categories');
			}

			$category->user_id = Auth::user()->id;
			$category->parent_id = Input::get('parent_id');
			$category->name = Input::get('name');
			$category->description = Input::get('description');

			$category->save();

			Session::flash('message', 'Updated category #'.$category->id);

			return Redirect::to_route('users.categories');
		}

		else
		{
			return Redirect::to_route('users.categories.edit', array( 'category_id' => $category_id))
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific category.
	 *
	 * @param  int       $category_id
	 * @return Response
	 */
	public function get_delete($category_id)
	{
		$category = Category::find($category_id);

		if( ! is_null($category))
		{
			$category->delete();

			Session::flash('message', 'Deleted category #'.$category->id);
		}

		return Redirect::to_route('users.categories');
	}
}