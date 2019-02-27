<?php

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

//GET Random API Key
$router->get('/key', function () {
    return str_random(32);
});

$router->post('/register', ['uses' => 'AuthController@register']);
$router->post('/login', ['uses' => 'AuthController@login']);

$router->group(['prefix' => 'api'], function () use ($router) {
    //Users Data With GET ALL, GET ONE, ADD, EDIT, DELETE
    $router->get('users',  ['uses' => 'UserController@showAll']);

    $router->get('users/{id}', ['uses' => 'UserController@showOne']);

    $router->post('users', ['uses' => 'UserController@create']);

    $router->delete('users/{id}', ['uses' => 'UserController@delete']);

    $router->put('users/{id}', ['uses' => 'UserController@update']);

    //Bioskop Data With GET ALL, GET ONE, ADD, EDIT, DELETE
    $router->get('posts',  ['uses' => 'BioskopController@showAll']);

    $router->get('posts/{id}', ['uses' => 'BioskopController@showOne']);

    $router->post('posts', ['uses' => 'BioskopController@create']);

    $router->delete('posts/{id}', ['uses' => 'BioskopController@delete']);

    $router->put('posts/{id}', ['uses' => 'BioskopController@update']);
});