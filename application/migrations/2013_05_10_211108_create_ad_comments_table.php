<?php

class Create_Ad_Comments_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('ad_comments', function($table)
		{
			$table->increments('id');

			$table->integer('ad_id');
			$table->integer('user_id');
			
			$table->string('title');
			$table->text('body');
			$table->text('people_mentioned');
			$table->text('people_ids');
			
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
		Schema::drop('ad_comments');
	}

}