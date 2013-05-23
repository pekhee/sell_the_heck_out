<?php

class User extends Eloquent {

	/**
	 * The name of the table associated with the model.
	 *
	 * @var string
	 */
	public static $table = 'users';

	/**
	 * Indicates if the model has update and creation timestamps.
	 *
	 * @var bool
	 */
	public static $timestamps = false;

	/**
	 * Establish the relationship between a user and todos.
	 *
	 * @return Laravel\Database\Eloquent\Relationships\Has_Many
	 */
	public function ads()
	{
		return $this->has_many('Ad');
	}
	
	public function profile(){
		return $this->has_one('User_Profile');
	}
}