<?php

class Ads_Comments_Controller extends Base_Controller {

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
	public function get_index($user_id = null, $ad_id = null)
	{
		$comments = Ad_Comment::with(array('user', 'ad'))->get();
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Ad Comments';
			$this->layout->content = View::make('ads.comments.index')->with(array(
					'comments' 	=> $comments,
					'user_id' 	=> $user_id,
					'ad_id' 	=> $ad_id,
				));
		}
	}

	/**
	 * Show the form to create a new comment.
	 *
	 * @return void
	 */
	public function get_create($user_id = null, $ad_id = null)
	{
		$this->layout->title   = 'New Ad Comment';
		$this->layout->content = View::make('ads.comments.create', array(
									'user_id' => $user_id,
									'ad_id' => $ad_id,
								));
	}

	/**
	 * Create a new comment.
	 *
	 * @return Response
	 */
	public function post_create($user_id = null, $ad_id = null)
	{
		$validation = Validator::make(Input::all(), array(
			'title' => array('required'),
			'body' => array('required'),
		));

		if($validation->valid())
		{
			$comment = new Ad_Comment;

			$comment->ad_id = $ad_id;
			$comment->user_id = $user_id;
			$comment->title = Input::get('title');
			$comment->body = Input::get('body');

			$comment->save();

			Session::flash('message', 'Added comment #'.$comment->id);

			return Redirect::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id));
		}

		else
		{
			return Redirect::to_route('users.ads.comments.new', array( 'user_id' => $user_id, 'ad_id' => $ad_id))
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
	public function get_view($user_id = null, $ad_id = null, $comment_id = null)
	{
		$comment = Ad_Comment::with(array('user', 'ad'))->find($comment_id);

		if(is_null($comment))
		{
			return Redirect::to_route('users.ads.comments');
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Viewing Ad Comment #'.$comment_id;
			$this->layout->content = View::make('ads.comments.view')->with('comment', $comment);
		}
	}

	/**
	 * Show the form to edit a specific comment.
	 *
	 * @param  int   $id
	 * @return void
	 */
	public function get_edit($user_id = null, $ad_id = null, $comment_id = null)
	{
		$comment = Ad_Comment::find($comment_id);

		if(is_null($comment))
		{
			return Redirect::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id));
		}
		
		if(Input::get('alt') == 'json'){
			return Response::eloquent($comments);
		}
		else{
			$this->layout->title   = 'Editing Ad Comment';
			$this->layout->content = View::make('ads.comments.edit')->with('comment', $comment);
		}
	}

	/**
	 * Edit a specific comment.
	 *
	 * @param  int       $id
	 * @return Response
	 */
	public function post_edit($user_id = null, $ad_id = null, $comment_id = null)
	{
		$validation = Validator::make(Input::all(), array(
			'title' => array('required'),
			'body' => array('required'),
		));

		if($validation->valid())
		{
			$comment = Ad_Comment::find($comment_id);

			if(is_null($comment))
			{
				return Redirect::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id));
			}

			$comment->ad_id = $ad_id;
			$comment->user_id = $user_id;
			$comment->title = Input::get('title');
			$comment->body = Input::get('body');

			$comment->save();

			Session::flash('message', 'Updated comment #'.$comment->id);

			return Redirect::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id));
		}

		else
		{
			return Redirect::to_route('users.ads.comments.edit/',array( 'user_id' => $user_id, 'ad_id' => $ad_id, 'comment_id' => $comment_id))
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
	public function delete_delete($user_id = null, $ad_id = null, $comment_id = null)
	{
		$comment = Ad_Comment::find($comment_id);

		if( ! is_null($comment))
		{
			$comment->delete();

			Session::flash('message', 'Deleted comment #'.$comment->id);
		}

		return Redirect::to_route('users.ads.comments', array( 'user_id' => $user_id, 'ad_id' => $ad_id) );
	}
}