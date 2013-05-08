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

// Loading Controllers
Route::controller(array(
));

//Explicit Route Overrides
Route::get('/', array('before' => 'auth', 'as' => 'home', 'uses' => 'user@index'));

Route::get('login', 'user@login');
Route::post('login', 'user@login');
Route::get('register', 'user@register');
Route::post('register', 'user@register');
Route::get('logout', 'user@logout');
Route::post('logout', 'user@logout');

Route::group(array('before' => 'auth|role:student'), function() {
  Route::get('student', 'student@index');
  Route::get('student/request', 'student@request');
  Route::post('student/request', 'student@request');
});

Route::group(array('before' => 'auth|role:instructor'), function() {
  Route::get('instructor', 'instructor@index');
  Route::get('instructor/add_course', 'instructor@add_course');
  Route::post('instructor/add_course', 'instructor@add_course');
  Route::get('instructor/view_section/(:num)', 'instructor@view_section');
  Route::get('instructor/view_course/(:num)', 'instructor@view_course');
  Route::get('instructor/view_student/(:num)', 'instructor@view_student');
  Route::get('instructor/view_request/(:num)', 'instructor@view_request');
  Route::get('instructor/accept_request/(:num)', 'instructor@accept_request');
  Route::get('instructor/deny_request/(:num)', 'instructor@deny_request');
});


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
  $user = Session::get('user');
  $role = Session::get('role');
  if(Auth::guest() || is_null($user) || is_null($role)) {
    return Redirect::to('login');
  }
});

Route::filter('role', function($role) {
  $user = Session::get('user');
  $my_role = Session::get('role');

  if($my_role !== $role) {
    return Response::error('403');
  }
});
