<?php

class Create_Users_Profiles_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('users_profiles', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->string('name');
			$table->string('last_name');
			$table->string('city');
			$table->string('country');
			$table->string('time_zone');
			$table->string('pic_link');

			$table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_profiles');
	}

}