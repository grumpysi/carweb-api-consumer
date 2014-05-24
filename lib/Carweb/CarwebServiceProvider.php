<?php namespace Carweb;

use Carweb\Cache\TempFileCache;
use Illuminate\Support\ServiceProvider;

class CarwebServiceProvider extends ServiceProvider {

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('nixilla/carweb-api-consumer', 'nixilla/carweb-api-consumer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        // Register 'underlyingclass' instance container to our UnderlyingClass object
        $this->app['Consumer'] = $this->app->share(function($app)
        {
			
			$api_config 	= $app['config']['app']['credentials'];
			
			$strUserName 	= $api_config['carweb_username'];
			$strPassword 	= $api_config['carweb_password'];
			$strKey1 		= $api_config['carweb_key'];
			
			$client = new \Buzz\Browser(new \Buzz\Client\Curl());
            return new Consumer($client, $strUserName, $strPassword, $strKey1, new TempFileCache());
        });

        // Shortcut so developers don't need to add an Alias in app/config/app.php
        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Carweb', 'Carweb\Facades\Laravel\Carweb');
        });
	}
}

