<?php

class Ad_Comment extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'ad_comments';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	/**
	 * Establish the relationship between a comment and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}

	/**
	 * Establish the relationship between a comment and a todo.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function ad()
	{
		return $this->belongs_to('Ad');
	}
	
}