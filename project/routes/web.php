<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\UserController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api'], function() use ($router){
    $router->group(['prefix'=>'users'], function() use ($router){
        $router->get('/','UserController@list');
        $router->post('/register','UserController@register');
        $router->post('/login','UserController@login');
        $router->put('/{id}','UserController@update');
        $router->delete('/{id}','UserController@delete');
    });

    $router->group(['prefix'=>'lottery_games'], function() use ($router){
        $router->get('/','LotteryGameController@list');
    });

    
});