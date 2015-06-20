<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->get('/',              ['as' => 'index', 'uses' => 'Controller@index']);
$app->get('/progression',   ['as' => 'progression', 'uses' => 'Controller@progression']);

$app->post('/api',          ['as' => 'api', 'uses' => 'ApiController@check']);
