<?php

require_once("application/libraries/faker/src/autoload.php");
require_once("application/libraries/app/appconf.php");
class Seed_Users extends \S2\Seed {
	
    public function grow(){
        $num = 128;
		$multi = 4;
		$faker = Faker\Factory::create();
		for($i = 0; $i<$num; $i++){
			$user = new User;
			$user->username = 	$faker->userName();
			$user->password = 	$faker->words(2, true);
			$user->email 	=	$faker->email();
			$user->save();
			
			// Single relationship
			$profile = new User_Profile;
			
			$profile->user_id = $user->id;
			$profile->name = $faker->firstName();
			$profile->last_name = $faker->lastName();
			$profile->city = $faker->city();
			$profile->country = $faker->country();
			$profile->time_zone = $faker->timezone();
			$profile->pic_link = $faker->getImage(128, 128, path('public') . '/user_data/image/12');
			$profile->save();
			
			for($j = 0; $j<$multi; $j++){
				$todo = new Todo;
				
				$todo->user_id = $user->id;
				$todo->what = $faker->text();
				$rtime = $faker->unixTime();
				$todo->when = $rtime * mt_rand(1, 1.05);
				$todo->time_started = $rtime * mt_rand(0.95, 1);
				$todo->save();
				
				for($k = 0; $k<$multi; $k++){
					$comment = new Todo_Comment;
					
					$comment->user_id = $user->id;
					$comment->todo_id = $todo->id;
					$comment->title = $faker->catchPhrase();
					$comment->body = $faker->paragraphs(2, true);
					$comment->save();
					
					$category = new Todo_Category;
					
					$category->user_id = $user->id;
					$category->name = $faker->sentence();
					$category->description = $faker->paragraph();
					$category->save();
				}
				$todo->todo_category_id = $category->id; // THIS SHOULD CHANGE, INCORRECT RELATIONSHIP, SHOULD BE MANY TO MANY
				$todo->save();
			}
		}
		
    }

    // Seeds with a lower number are grown first.
    public function order(){
        return 100;
    }

}