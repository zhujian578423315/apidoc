<?php

namespace Leyao\ApiDoc;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
	const API_DOC_TAG = 'ApiDoc';

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->setConfig();
		$this->setPushes();
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	protected function setConfig()
	{
		$source = __DIR__ . '/config.php';
		$this->publishes([
			$source => config_path('apidoc.php'),
		], 'config');
		$this->mergeConfigFrom($source, 'apidoc');
	}

	protected function setPushes()
	{
		$config = config('apidoc');
		$pushes = [];
		foreach ($config['documents_dir'] as $targetDir) {
			$target = $config['documents_generate_dir'] . $targetDir;
			$pushes[$targetDir] = $target;
		}
		$this->publishes($pushes, self::API_DOC_TAG);
	}
}
