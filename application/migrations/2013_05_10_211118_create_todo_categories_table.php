<?php

class Create_Todo_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('todo_categories', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
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
		Schema::drop('todo_categories');
	}

}