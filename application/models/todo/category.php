<?php

class Todo_Category extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'todo_categories';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = true;

	/**
	 * Establish the relationship between a category and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}

	/**
	 * Establish the relationship between a category and todos.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function todos()
	{
		return $this->has_many('Todo');
	}
}