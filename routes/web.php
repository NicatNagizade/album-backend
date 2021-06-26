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

$router->get('/', function () {
    // return $router->app->version();
    return view('swagger');
});

$router->group(['prefix' => 'api', 'middleware' => 'cors'], function($router) {
    $router->get('album', 'AlbumController@index');
});
