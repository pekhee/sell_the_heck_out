<?php

class Ad extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'ads';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = false;

	/**
	 * Establish the relationship between a todo and a user.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Belongs_To
	 */
	public function user()
	{
		return $this->belongs_to('User');
	}
	
	public function comments(){
		return $this->has_many('Ad_Comment');
	}
	
	public function categories(){
		return $this->has_many_and_belongs_to('Category', 'ads_categories');
	}
}