<?php

class Category extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'categories';

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
	public function ads()
	{
		return $this->has_many_and_belongs_to('Ad', 'ads_categories');
	}


	/**
	 * Establish the relationship between categories
	 * Each category has a parent with same type and
	 * many children also with same type
	 * 
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function parent(){
		return $this->belongs_to('Category', 'parent_id');
	}

	public function children(){
		return $this->has_many('Categories', 'parent_id');
	}
}