<?php

class Add_Todo_Category_Id_To_Todos {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('todos', function($table){
			$table->integer('todo_category_id');
		});
		
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('todos', function($table){
			$table->drop_column('todo_category_id');
		});
	}

}