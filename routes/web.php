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
// use Illuminate\Support\Facades\Hash;
// dd(Hash::make('test123'));

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/ping', function () use ($router) {
    return 'Ping from server ' . date('Y-m-d H:i:s');
});

$router->get('redirect/{code}', 'QrcodeController@redirect');
$router->post('reset-password/', 'MailController@index');

$router->group(['prefix' => 'api'], function () use ($router) {
  $router->post('login','AdminController@authenticate');
});

// API Routes
$router->group(['prefix' => 'api', 'middleware' => 'auth'], function () use ($router) {
  $router->get('/user', 'AdminController@user');
  $router->put('/user/{id}', 'AdminController@update');
  $router->get('/qrcode', 'QrcodeController@index');
  $router->get('/qrcode/{id}', 'QrcodeController@show');
  $router->post('/qrcode','QrcodeController@create');
  $router->put('/qrcode/{id}', 'QrcodeController@update');
  $router->delete('/qrcode/{id}', 'QrcodeController@delete');
});
