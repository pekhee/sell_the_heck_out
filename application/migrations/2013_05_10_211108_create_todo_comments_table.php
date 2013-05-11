<?php

class Create_Todo_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('todo_comments', function($table)
		{
			$table->increments('id');

			$table->integer('todo_id');
			$table->integer('user_id');
			$table->string('title');
			$table->text('body');

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
		Schema::drop('todo_comments');
	}

}