<?php

class Create_Ad_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('categories', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('parent_id'); // Connection to self
			
			$table->string('name');
			$table->text('description');

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
		Schema::drop('ad_categories');
	}

}