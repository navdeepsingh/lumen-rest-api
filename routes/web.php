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
$router->get('/phpinfo', function () {
    return phpinfo();
});

$router->group(['prefix' => 'api/'], function () use ($router) {
  $router->post('login/','AdminController@authenticate');
});

$router->group(['prefix' => 'api/', 'middleware' => 'auth'], function () use ($router) {
  $router->get('qrcode/', 'QrcodeController@index');
  $router->get('qrcode/{id}/', 'QrcodeController@show');
  $router->post('qrcode/','QrcodeController@create');
  $router->put('qrcode/{id}/', 'QrcodeController@update');
  $router->delete('qrcode/{id}/', 'QrcodeController@delete');
});
