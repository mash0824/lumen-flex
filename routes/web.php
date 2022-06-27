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
/**
 * orignally i added a prefix api into the group,
 * then I just follow the instruction on what endpoints
 * i am going to create.
 */
$router->get('customers', [
    'as' => 'customers.index', 'uses' => 'CustomerController@index'
]);
$router->get('customers/{customerId}', [
    'as' => 'customers.show', 'uses' => 'CustomerController@show'
]);
