<?php

class Todos_Comments_Controller extends Base_Controller {

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
	 * View all of the comments.
	 *
	 * @return void
	 */
	public function get_index()
	{
		$comments = Todo_Comment::with(array('user', 'todo'))->get();
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Todo Comments';
			$this->layout->content = View::make('todos.comments.index')->with('comments', $comments);
		}
	}

	/**
	 * Show the form to create a new comment.
	 *
	 * @return void
	 */
	public function get_create($user_id = null, $todo_id = null)
	{
		$this->layout->title   = 'New Todo Comment';
		$this->layout->content = View::make('todos.comments.create', array(
									'user_id' => $user_id,
									'todo_id' => $todo_id,
								));
	}

	/**
	 * Create a new comment.
	 *
	 * @return Response
	 */
	public function post_create()
	{
		$validation = Validator::make(Input::all(), array(
			'todo_id' => array('required', 'integer'),
			'title' => array('required'),
			'body' => array('required'),
		));

		if($validation->valid())
		{
			$comment = new Todo_Comment;

			$comment->todo_id = Input::get('todo_id');
			$comment->user_id = Auth::user()->id;
			$comment->title = Input::get('title');
			$comment->body = Input::get('body');

			$comment->save();

			Session::flash('message', 'Added comment #'.$comment->id);

			return Redirect::to('todos/comments');
		}

		else
		{
			return Redirect::to('todos/comments/create')
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * View a specific comment.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_view($id)
	{
		$comment = Todo_Comment::with(array('user', 'todo'))->find($id);

		if(is_null($comment))
		{
			return Redirect::to('todos/comments');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Viewing Todo Comment #'.$id;
			$this->layout->content = View::make('todos.comments.view')->with('comment', $comment);
		}
	}

	/**
	 * Show the form to edit a specific comment.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($id)
	{
		$comment = Todo_Comment::find($id);

		if(is_null($comment))
		{
			return Redirect::to('todos/comments');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Editing Todo Comment';
			$this->layout->content = View::make('todos.comments.edit')->with('comment', $comment);
		}
	}

	/**
	 * Edit a specific comment.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($id)
	{
		$validation = Validator::make(Input::all(), array(
			'todo_id' => array('required', 'integer'),
			'title' => array('required'),
			'body' => array('required'),
		));

		if($validation->valid())
		{
			$comment = Todo_Comment::find($id);

			if(is_null($comment))
			{
				return Redirect::to('todos/comments');
			}

			$comment->todo_id = Input::get('todo_id');
			$comment->user_id = Auth::user()->id;
			$comment->title = Input::get('title');
			$comment->body = Input::get('body');

			$comment->save();

			Session::flash('message', 'Updated comment #'.$comment->id);

			return Redirect::to('todos/comments');
		}

		else
		{
			return Redirect::to('todos/comments/edit/'.$id)
					->with_errors($validation->errors)
					->with_input();
		}
	}

	/**
	 * Delete a specific comment.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function get_delete($id)
	{
		$comment = Todo_Comment::find($id);

		if( ! is_null($comment))
		{
			$comment->delete();

			Session::flash('message', 'Deleted comment #'.$comment->id);
		}

		return Redirect::to('todos/comments');
	}
}