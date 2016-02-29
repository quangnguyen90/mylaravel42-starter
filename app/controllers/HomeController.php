<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function helloworld()
	{
		return View::make('home.helloworld')->with(array('name'=>'Quang Master ^^', 'website'=>'yolo.com'));
	}

	public function helloNest()
	{
		$dataHome = array('father' => 'Quang Nguyen - Shared from HomeController');
		$dataNest = array('nest' => 'Nest - Shared from HomeController');
		return View::make('home.hellonest', $dataHome)->nest('bienNest','home.child.child', $dataNest);
	}

	public function helloLayout()
	{
		$data = array(
			'qwerty' => 'lorem ispum....', 
			'name'=>'Quang'
		);
		return View::make('home.helloLayout', $data);
	}

	public function login(){
	    return View::make('home.login');
	}

	public function checkLogin(){
	    $userdata = array(
	        'username' => Input::get('username'),
	        'password' => Input::get('password')
	    );
	     
	    if(Auth::attempt($userdata)){
	        $user = User::find(Auth::user()->id);
	        if($user->role->alias === 'admin'){
	            return Redirect::to('admin');
	        }
	    }
	    return Redirect::to('login');
	}
}
