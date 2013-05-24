<?php
class AppHelper{
	/*
	|--------------------------------------------------------------------------
	| Explode then trim input
	|--------------------------------------------------------------------------
	| Explodes a string, traverses all values and stripes white spaces from them 
	|
	| @author Pooyan Khosravi
	| @param $string
	|   This string will be exploded
	| @param $delimiter
	|   With this delimiter
	| @return array
	|   Array of trimed values
	| 
	*/
	public static function explode_and_trim($string, $delimiter){
		$peices = explode($delimiter, $string);
		$i = 0;
		foreach( $peices as $peice){
			$peices[$i] = trim($peice);
			$i++;
		}
		
		return $peices;
	}

	/*
	|--------------------------------------------------------------------------
	| Insert relation to eloquent if relatee is not null
	|--------------------------------------------------------------------------
	| @return boolean
	|   returns true unless save was not successful
	*/
	public static function insert_if_exists($eloquent, $relatee, $relation){
		if(!is_null($relatee)){
			($relatee->id == null) ? $relatee->save()  :false;
			($eloquent->id == null)? $eloquent->save() :false;
			
			return call_user_func(array($eloquent, $relation))->attach($relatee);
		}
		return false;
	}
}