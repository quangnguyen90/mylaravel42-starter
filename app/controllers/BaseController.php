<?php

class BaseController extends Controller {

	function __construct() {
		View::share("Muser","Master User - Shared from BaseController");
	}
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
