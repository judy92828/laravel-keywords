<?php

namespace JingJing\Keywords\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use JingJing\Keywords\NotAllowStr;

class NotAllowStrServiceProvide extends ServiceProvider
{

  public function register()
  {
    $this->app->singleton('JKeywords', NotAllowStr::class);
  }

  public function boot()
  {
    $this->registerRoutes();

    $this->loadViewsFrom(
      __DIR__ . '/../resources/views', 'jjKeywords'
    );
  }

  private function routeConfiguration()
  {
    return [
      'namespace' => 'JingJing\Keywords\Test\Http\Controllers',
      'prefix' => 'JKeywords',
    ];
  }

  private function registerRoutes()
  {
    Route::group($this->routeConfiguration(), function () {
      $this->loadRoutesFrom(__DIR__ . '/../Routes/routes.php');
    });
  }

}