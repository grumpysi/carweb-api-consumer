<?php namespace Carweb\Facades\Laravel;

use Illuminate\Support\Facades\Facade;

class Carweb extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'Consumer';
	}


}