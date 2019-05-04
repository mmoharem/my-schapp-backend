<?php

namespace App\Providers;


use App\Repositories\UserRepositoriesInterface;
use App\Repositories\UserRepositories;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppBindingServiceProvider extends ServiceProvider
{
    public function register() {
//        $this->app->bind('App\Repositories\UserRepositoriesInterface', 'App\Repositories\UserRepositories');
        $this->app->bind(UserRepositoriesInterface::class, UserRepositories::class);

//        $this->app->bind(UserRepositoriesInterface::class, function ($app) {
//            return new UserRepositories(new User());
//        });
    }
}