<?php

namespace admin;
use \View;
class HomeController extends \admin\BaseController {

	public function showWelcome()
	{
		return View::make('admin.home.index');
	}

	public function helloworld()
	{
		return View::make('home.helloworld')->with(array('name'=>'Quang Super ^^', 'website'=>'yala.com'));
	}
}
