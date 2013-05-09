<?php

class Create_Todos_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('todos', function($table)
		{
			$table->increments('id');

			$table->integer('user_id');
			$table->text('what');
			$table->date('when');
			$table->date('time_started');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('todos');
	}

}