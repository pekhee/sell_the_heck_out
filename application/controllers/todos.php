<?php

class Todos_Controller extends Base_Controller {

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
	 * View all of the todos.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$todos = Todo::with(array('user'))->get();
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($todos);
		}
		else{
			$this->layout->title   = 'Todos';
			$this->layout->content = View::make('todos.index')->with('todos', $todos);
		}
	}

	/**
	 * Show the form to create a new todo.
	 *
	 * @return void
	 */
	public function get_create($user_id = null)
	{
		$this->layout->title   = 'New Todo';
		$this->layout->content = View::make('todos.create', array(
									'user_id' => $user_id,
								));
	}

	/**
	 * Create a new todo.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'what' => array('required'),
			'when' => array('required'),
		));

		if($validation->valid())
		{
			$todo = new Todo;

			$todo->user_id = Input::get('user_id');
			$todo->what = Input::get('what');
			$todo->when = Input::get('when');
			$todo->time_started = Input::get('time_started', time() );

			$todo->save();

			Session::flash('message', 'Added todo #'.$todo->id);

			return Redirect::to('todos');
		}

		else
		{
			return Redirect::to('todos/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific todo.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$todo = Todo::with(array('user'))->find($id);

		if(is_null($todo))
		{
			return Redirect::to('todos');
		}
		
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($todo);
		}
		else{
			$this->layout->title   = 'Viewing Todo #'.$id;
			$this->layout->content = View::make('todos.view')->with('todo', $todo);
		}
	}

	/**
	 * Show the form to edit a specific todo.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$todo = Todo::find($id);

		if(is_null($todo))
		{
			return Redirect::to('todos');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($todo);
		}
		else{
			$this->layout->title   = 'Editing Todo';
			$this->layout->content = View::make('todos.edit')->with('todo', $todo);
		}
	}

	/**
	 * Edit a specific todo.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'user_id' => array('required', 'integer'),
			'what' => array('required'),
			'when' => array('required'),
			'time_started' => array('required'),
		));

		if($validation->valid())
		{
			$todo = Todo::find($id);

			if(is_null($todo))
			{
				return Redirect::to('todos');
			}

			$todo->user_id = Input::get('user_id');
			$todo->what = Input::get('what');
			$todo->when = Input::get('when');
			$todo->time_started = Input::get('time_started');

			$todo->save();

			Session::flash('message', 'Updated todo #'.$todo->id);

			return Redirect::to('todos');
		}

		else
		{
			return Redirect::to('todos/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific todo.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$todo = Todo::find($id);

		if( ! is_null($todo))
		{
			$todo->delete();

			Session::flash('message', 'Deleted todo #'.$todo->id);
		}

		return Redirect::to('todos');
	}
}