<?php

class Create_Join_Table_For_Ads_Categories {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up(){
		Schema::create('ads_categories', function($table){
			$table->increments('id');

			$table->integer('ad_id');
			$table->integer('category_id');

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
		Schema::drop('ads_categories');
	}

}