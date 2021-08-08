<?php


namespace Loecos\Funpay237\Providers;
use Illuminate\Support\ServiceProvider;

class FunPayServiceProvider extends  ServiceProvider
{
    /**
     * Publishes configuration file.
     *
     * @return  void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/funpay.php' => config_path('funpay.php'),
        ], 'funpay');
    }
    /**
     * Make config publishment optional by merging the config from the package.
     *
     * @return  void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/funpay.php',
            'funpay'
        );
    }

}
