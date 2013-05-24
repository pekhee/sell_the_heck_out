<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

// Bind filters to controllers
// Route::filter('pattern: users/(:num)/*', 'auth|https');

// Arbitrary routes
Route::get('/', array( 'as' => 'home', function()
{
	return View::make('home.index');
}));


// Login and Logout routes
Route::secure('GET', 	'users/login', 									array( 'before' => 'https', 'as' => 'user.login', 					'uses' => 'users@login'));
Route::secure('POST', 	'users/login/(:any?)',							array( 'before' => 'https', 'as' => 'user.login.s', 				'uses' => 'users@login'));

Route::secure('GET', 	'users/logout', 								array( 'before' => 'https|auth', 'as' => 'user.logout', 					'uses' => 'users@logout'));
Route::secure('POST', 	'users/logout', 								array( 'before' => 'https|auth', 'as' => 'user.logout.s', 				'uses' => 'users@logout'));

// Users URLS
Route::secure('GET', 	'users', 										array( 'before' => 'https', 'as' => 'users', 						'uses' => 'users@index')); 	// List all
Route::secure('GET', 	'users/(:num)', 								array( 'before' => 'https', 'as' => 'users.view', 					'uses' => 'users@view')); 	// Show
Route::secure('GET', 	'users/new', 									array( 'before' => 'https|auth', 'as' => 'users.new', 					'uses' => 'users@create')); 	// Creation form
Route::secure('POST', 	'users/new', 									array( 'before' => 'https|auth', 'as' => 'users.new.s', 					'uses' => 'users@create')); 	// Submit
Route::secure('GET', 	'users/(:num)/edit', 							array( 'before' => 'https|auth', 'as' => 'users.edit', 					'uses' => 'users@edit')); 	// Edit show current status
Route::secure('PUT', 	'users/(:num)/edit', 							array( 'before' => 'https|auth', 'as' => 'users.edit.s', 				'uses' => 'users@edit')); 	// Edit submit
Route::secure('GET', 	'users/(:num)/delete', 							array( 'before' => 'https|auth', 'as' => 'users.delete', 				'uses' => 'users@delete')); 	// Make sure
Route::secure('DELETE', 'users/(:num)/delete', 							array( 'before' => 'https|auth', 'as' => 'users.delete.s', 				'uses' => 'users@delete')); 	// Delete
Route::secure('DELETE', 'users/(:num)', 								array( 'before' => 'https|auth', 'as' => 'users.delete.s.alt',			'uses' => 'users@delete')); 	// Delete

// Profile URLS
Route::get(				'users/(:num)/profile', 						array( 'before' => '', 		'as' => 'users.profile.view', 			'uses' => 'users.profiles@view'));
Route::secure('GET',	'users/(:num)/profile/new',						array( 'before' => 'https|auth', 'as' => 'users.profile.new', 			'uses' => 'users.profiles@create'));
Route::secure('POST',	'users/(:num)/profile/new', 					array( 'before' => 'https|auth', 'as' => 'users.profile.new.s', 			'uses' => 'users.profiles@create'));
Route::secure('GET',	'users/(:num)/profile/edit', 					array( 'before' => 'https|auth', 'as' => 'users.profile.edit', 			'uses' => 'users.profiles@edit'));
Route::secure('PUT',	'users/(:num)/profile/edit', 					array( 'before' => 'https|auth', 'as' => 'users.profile.edit.s', 		'uses' => 'users.profiles@edit'));
Route::secure('GET',	'users/(:num)/profile/delete', 					array( 'before' => 'https|auth', 'as' => 'users.profile.delete', 		'uses' => 'users.profiles@delete'));
Route::secure('DELETE',	'users/(:num)/profile/delete', 					array( 'before' => 'https|auth', 'as' => 'users.profile.delete.s', 		'uses' => 'users.profiles@delete'));
Route::secure('DELETE',	'users/(:num)/profile', 						array( 'before' => 'https|auth', 'as' => 'users.profile.delete.s.alt',	'uses' => 'users.profiles@delete'));

// Ads URLS
Route::secure('GET', 	'users/(:num)/ads', 							array( 'before' => 'https', 'as' => 'users.ads', 					'uses' => 'ads@index'));
Route::secure('GET', 	'users/(:num)/ads/(:num)', 						array( 'before' => 'https', 'as' => 'users.ads.view', 				'uses' => 'ads@view'));
Route::secure('GET', 	'users/(:num)/ads/new', 						array( 'before' => 'https|auth', 'as' => 'users.ads.new', 				'uses' => 'ads@create'));
Route::secure('POST', 	'users/(:num)/ads/new', 						array( 'before' => 'https|auth', 'as' => 'users.ads.new.s', 				'uses' => 'ads@create'));
Route::secure('GET', 	'users/(:num)/ads/(:num)/edit', 				array( 'before' => 'https|auth', 'as' => 'users.ads.edit', 				'uses' => 'ads@edit'));
Route::secure('PUT', 	'users/(:num)/ads/(:num)/edit', 				array( 'before' => 'https|auth', 'as' => 'users.ads.edit.s', 			'uses' => 'ads@edit'));
Route::secure('GET', 	'users/(:num)/ads/(:num)/delete', 				array( 'before' => 'https|auth', 'as' => 'users.ads.delete', 			'uses' => 'ads@delete'));
Route::secure('DELETE', 'users/(:num)/ads/(:num)/delete', 				array( 'before' => 'https|auth', 'as' => 'users.ads.delete.s', 			'uses' => 'ads@delete'));
Route::secure('DELETE', 'users/(:num)/ads/(:num)', 						array( 'before' => 'https|auth', 'as' => 'users.ads.delete.s.alt', 		'uses' => 'ads@delete'));

// Comments URLS
Route::get(				'users/(:num)/ads/(:num)/comments', 					array( 'before' => '', 		'as' => 'users.ads.comments', 				'uses' => 'ads.comments@index'));
Route::secure('GET',	'users/(:num)/ads/(:num)/comments/(:num)',				array( 'before' => 'https', 'as' => 'users.ads.comments.view', 			'uses' => 'ads.comments@view'));
Route::secure('GET',	'users/(:num)/ads/(:num)/comments/new',					array( 'before' => 'https|auth', 'as' => 'users.ads.comments.new', 			'uses' => 'ads.comments@create'));
Route::secure('POST',	'users/(:num)/ads/(:num)/comments/new', 				array( 'before' => 'https|auth', 'as' => 'users.ads.comments.new.s', 		'uses' => 'ads.comments@create'));
Route::secure('GET',	'users/(:num)/ads/(:num)/comments/(:num)/edit', 		array( 'before' => 'https|auth', 'as' => 'users.ads.comments.edit', 			'uses' => 'ads.comments@edit'));
Route::secure('PUT',	'users/(:num)/ads/(:num)/comments/(:num)/edit', 		array( 'before' => 'https|auth', 'as' => 'users.ads.comments.edit.s', 		'uses' => 'ads.comments@edit'));
Route::secure('GET',	'users/(:num)/ads/(:num)/comments/(:num)/delete', 		array( 'before' => 'https|auth', 'as' => 'users.ads.comments.delete', 		'uses' => 'ads.comments@delete'));
Route::secure('DELETE',	'users/(:num)/ads/(:num)/comments/(:num)/delete', 		array( 'before' => 'https|auth', 'as' => 'users.ads.comments.delete.s', 		'uses' => 'ads.comments@delete'));
Route::secure('DELETE',	'users/(:num)/ads/(:num)/comments/(:num)/', 			array( 'before' => 'https|auth', 'as' => 'users.ads.comments.delete.s.alt', 	'uses' => 'ads.comments@delete'));

Route::secure('GET',	'categories', 									array( 'before' => '',				'as' => 'users.categories',				'uses' => 'categories@index' ));
Route::secure('GET',	'categories/(:num)', 							array( 'before' => '',				'as' => 'users.categories.view',		'uses' => 'categories@view'  ));
Route::secure('GET',	'categories/new',		 						array( 'before' => 'https|auth',	'as' => 'users.categories.new',			'uses' => 'categories@create'));
Route::secure('POST',	'categories/new',		 						array( 'before' => 'https|auth',	'as' => 'users.categories.new.s',		'uses' => 'categories@create'));
Route::secure('GET',	'categories/(:num)/edit', 						array( 'before' => 'https|auth',	'as' => 'users.categories.edit',		'uses' => 'categories@edit'	 ));
Route::secure('PUT',	'categories/(:num)/edit', 						array( 'before' => 'https|auth',	'as' => 'users.categories.edit.s',		'uses' => 'categories@edit'	 ));
Route::secure('GET',	'categories/(:num)/delete', 					array( 'before' => 'https|auth',	'as' => 'users.categories.delete',		'uses' => 'categories@delete'));
Route::secure('DELETE',	'categories/(:num)/delete', 					array( 'before' => 'https|auth',	'as' => 'users.categories.delete.s',	'uses' => 'categories@delete'));
Route::secure('DELETE',	'categories/(:num)', 							array( 'before' => 'https|auth',	'as' => 'users.categories.delete.s.alt','uses' => 'categories@delete'));

Route::controller(Controller::detect()); // TODO: SECURITY HOLE

Route::get('re/(:any)', function(){ return Event::first('501'); });
Route::get('em/(:any)', function(){ return Event::first('501'); });
Route::get('(:any)', 	function(){ return Event::first('404'); });
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application. The exception object
| that is captured during execution is then passed to the 500 listener.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function($exception)
{
	return Response::error('500');
});

Event::listen('501', function($exception = null){
	return Response::error('501');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Route::get('/', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		})); 
|
*/

Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()){
		if(Input::get('alt') == 'json'){
			return json_encode( array(
				'error' => true,
				'message' => 'You should login first',
			));
		}
		else{
			Session::put('redirect_to', URL::current());
			return Redirect::to_route('user.login');
		}
	}
});

Route::filter('https', function() {
	if(Request::env() == 'production'){
		if (!Request::secure()) return Redirect::to_secure(URI::current());
	}
});