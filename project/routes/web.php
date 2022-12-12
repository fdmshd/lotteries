<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('/login', 'UserController@login');
        $router->post('/register', 'UserController@register');
        $router->get('/', ['middleware' => ['jwt.auth', 'admin'], 'uses' => 'UserController@list']);
        $router->get('/{id}', ['middleware' => ['jwt.auth', 'admin'],  'uses' => 'UserController@getByID']);
        $router->put('/{id}', ['middleware' => 'jwt.auth', 'uses' => 'UserController@update']);
        $router->delete('/{id}', ['middleware' => 'jwt.auth', 'uses' => 'UserController@delete']);
    });

    $router->group(['prefix' => 'lottery_games'], function () use ($router) {
        $router->get('/', 'LotteryGameController@list');
    });

    $router->group(['prefix' => 'lottery_game_matches'], function () use ($router) {
        $router->get('/', 'LotteryGameMatchController@getByLotteryID');

        $router->group(['middleware' => ['jwt.auth', 'admin']], function () use ($router) {
            $router->post('/', 'LotteryGameMatchController@create');
            $router->put('/{id}', 'LotteryGameMatchController@finish');
        });
    });

    $router->group(['prefix' => 'lottery_game_match_users', 'middleware' => 'jwt.auth'], function () use ($router) {
        $router->post('/', 'LotteryGameMatchUserController@signUpForMatch');
    });
});
