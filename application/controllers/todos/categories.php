<?php

class Todos_Categories_Controller extends Base_Controller {

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
		$categories = Todo_Category::with(array('user', 'todos'))->get();
		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Todo Categories';
			$this->layout->content = View::make('todos.categories.index')->with('categories', $categories);
		}
	}

	/**
	 * Show the form to create a new category.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
		$this->layout->title   = 'New Todo Category';
		$this->layout->content = View::make('todos.categories.create', array(
									'user_id' => $user_id,
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
		));

		if($validation->valid())
		{
			$category = new Todo_Category;

			$category->user_id = Auth::user()->id;
			$category->name = Input::get('name');
			$category->description = Input::get('description');

			$category->save();

			Session::flash('message', 'Added category #'.$category->id);

			return Redirect::to('todos/categories');
		}

		else
		{
			return Redirect::to('todos/categories/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific category.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$category = Todo_Category::with(array('user', 'todos'))->find($id);
		if(is_null($category))
		{
			return Redirect::to('todos/categories');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Viewing Todo Category #'.$id;
			$this->layout->content = View::make('todos.categories.view')->with('category', $category);
		}
	}

	/**
	 * Show the form to edit a specific category.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$category = Todo_Category::find($id);

		if(is_null($category))
		{
			return Redirect::to('todos/categories');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($categories);
		}
		else{
			$this->layout->title   = 'Editing Todo Category';
			$this->layout->content = View::make('todos.categories.edit')->with('category', $category);
		}
	}

	/**
	 * Edit a specific category.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'name' => array('required'),
			'description' => array('required'),
		));

		if($validation->valid())
		{
			$category = Todo_Category::find($id);

			if(is_null($category))
			{
				return Redirect::to('todos/categories');
			}

			$category->user_id = Auth::user()->id;
			$category->name = Input::get('name');
			$category->description = Input::get('description');

			$category->save();

			Session::flash('message', 'Updated category #'.$category->id);

			return Redirect::to('todos/categories');
		}

		else
		{
			return Redirect::to('todos/categories/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific category.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$category = Todo_Category::find($id);

		if( ! is_null($category))
		{
			$category->delete();

			Session::flash('message', 'Deleted category #'.$category->id);
		}

		return Redirect::to('todos/categories');
	}
}