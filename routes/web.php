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
$router->get('phpinfo', function () {
    return phpinfo();
});

$router->group(['prefix' => 'api/'], function () use ($router) {
  $router->post('login/','AdminController@authenticate');
  $router->post('qrcode/','QrcodeController@store');
  $router->get('qrcode/', 'QrcodeController@index');
  $router->get('qrcode/{id}/', 'QrcodeController@show');
  $router->put('qrcode/{id}/', 'QrcodeController@update');
  $router->delete('qrcode/{id}/', 'QrcodeController@destroy');
});
