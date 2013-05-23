<?php

class AppConf{

	public static $data = array(
		'seed.num' => 145,
		'seed.multiplyer' => 4,
	
	
	);

	public static function set($key, $value, $override){
		$old_value = array_get($data, $key, null);
		if( ($overrid == true) && ($old_value != null) ){
			$value = $old_value;
		}
		array_set(static::$data, $key, $value);
	}

	public static function get($key, $default){
		return array_get(static::$data, $key, $default);
	}









}