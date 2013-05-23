<?php

class Create_Ads_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::create('ads', function($table)
		{
			$table->increments('id');

			$table->integer(	'user_id');
			$table->integer(	'good_id'); // Goodies id

			$table->string(		'good_type'); // Goodies type that we want to sell
			
			$table->string( 	'title');
			$table->text(		'img_links');
			$table->text(		'description');

			$table->integer(	'price');
			$table->integer(	'num_visits');
			$table->string(		'promotions');
			$table->string(		'price_type');
			$table->boolean(	'offer_type');
			$table->string(		'seller_type');
			
			
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
		Schema::drop('ads');
	}

}