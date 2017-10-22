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
$router->group([
    'prefix' => 'api/v1', 'middleware' => ['cors', 'log']], function () use ($router) {


    $router->group([
        'prefix'    => '/components',
        'namespace' => 'Component'], function () use ($router) {


        $router->post('/', ['uses' => 'ComponentController@store']);
        $router->get('/{id:[\d]+}', ['uses' => 'ComponentController@show']);


        $router->get('/{id:[\d]+}/indicators', ['uses' => 'ComponentIndicatorController@index']);
        $router->get('/{id:[\d]+}/indicators/{id2:[\d]+}', ['uses' => 'ComponentIndicatorController@show']);

        $router->get('/{id:[\d]+}/attributeissues', ['uses' => 'ComponentAttributeIssueController@index']);
        $router->get('/{id:[\d]+}/attributeissues2', ['uses' => 'ComponentAttributeIssueController@index2']);


    });
});


