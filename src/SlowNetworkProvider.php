<?php

namespace SanTran\SlowNetwork;

use Illuminate\Support\ServiceProvider;

class SlowNetworkProvider extends ServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        $this->publishes([
          __DIR__ . '/views/slownetwork.blade.php' => resource_path('views/slownetwork/slownetwork.blade.php'),
          ]);
        $this->publishes([
            __DIR__ . '/config/slownetwork.php' => config_path('slownetwork.php'),
        ]);
    }

    public function register()
    {
        include __DIR__ . '/routes.php';
        $this->app->make('SanTran\SlowNetwork\SlowNetworkController');
    }

}
