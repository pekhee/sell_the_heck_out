<?php

// Checks to see if variable is seted.
function g(&$var, $def = 'Not setted'){	
	if(isset($var)){
		return $var;
	}
	else{
		return $def;
	}
}

/**
*|--------------------------------------------------------------------------
*| Object data handlers
*|--------------------------------------------------------------------------
*| Test if $object has $property, if so return $property
*| 
*| If $object has a method with $property's name, then 
*| return result of that method call.
*| 
*| In case all fails, return default.
*| 
*| @param $object
*| 	Object to be tested
*| @param $property
*| 	Property to test Object with
*| @param $default
*| 	what should be returned if test fails
*| @param $force
*| 	should getting property from object be forced?
*| 		Case TRUE: Checks if $object is an object, then return result, errors are supressed. 
*| @return mixed
*|	result of method or property expression or in case of failure, $default
*| @author Pooyan Khosravi
*/
function object_get($object, $property, $default = null, $force = false){
	if(is_object($object)){

		// is $object a subclass of Eloquent?
		(is_subclass_of($object, 'Laravel\Database\Eloquent\Model')) ? $eloquent=true : $eloquent=false;
		
		//will be supressed in eloquent case, no need to complicate things
		if(property_exists($object, $property) || $force){
			$value = (!$force) ? $object->$property : @$object->$property;
			if($value == null && $force){
				return $default;
			}
			else{
				return $value;
			}
		}
		if($eloquent){
			$value = $object->$property;
			return ( $value != null ) ? $value : $default;
		}
		if(method_exists($object, $property)){
			return call_user_func(array($object, $property));
		}
	}
	return $default;
}

function sanitize($string, $force_lowercase = true, $anal = false) {
    $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                   "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                   "�", "�", ",", "<", ".", ">", "/", "?");
    $clean = trim(str_replace($strip, "", strip_tags($string)));
    $clean = preg_replace('/\s+/', "-", $clean);
    $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
    return ($force_lowercase) ?
        (function_exists('mb_strtolower')) ?
            mb_strtolower($clean, 'UTF-8') :
            strtolower($clean) :
        $clean;
}

 /** 
  * Using php's built-in functions, creates a zip file.
  * 
  * @param $files: an array containing path to existing files, either relative or absolout
  * @param $destination: where to save the zip file
  * @param $overwrite: should overwrite previous zip file?
  * @author David Walsh	
  *
  */
function zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}