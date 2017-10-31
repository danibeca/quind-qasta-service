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
        $router->put('/{id:[\d]+}', ['uses' => 'ComponentController@update']);
        $router->delete('/{id:[\d]+}', ['uses' => 'ComponentController@destroy']);


        $router->get('/{id:[\d]+}/indicators', ['uses' => 'ComponentIndicatorController@index']);
        $router->get('/{id:[\d]+}/indicators/{id2:[\d]+}', ['uses' => 'ComponentIndicatorController@show']);


        $router->get('/{id:[\d]+}/attributeissues', ['uses' => 'ComponentAttributeIssueController@index']);
        $router->get('/{id:[\d]+}/attributeissues2', ['uses' => 'ComponentAttributeIssueController@index2']);

        $router->post('/{id:[\d]+}/indicator-values', ['uses' => 'ComponentIndicatorValueController@store']);
        $router->post('/{id:[\d]+}/quality-attribute-values', ['uses' => 'ComponentQualityAttributeValueController@store']);
        $router->post('/{id:[\d]+}/information-values', ['uses' => 'ComponentInformationValueController@store']);

        $router->get('/{id:[\d]+}/ci-indicators', ['uses' => 'ComponentCiIndicatorController@index']);
        $router->get('/{id:[\d]+}/ci-indicators/{id2:[\d]+}', ['uses' => 'ComponentCiIndicatorController@show']);
        $router->get('/{id:[\d]+}/ci-automation-phases', ['uses' => 'ComponentCiAutomationController@index']);

        $router->post('/{id:[\d]+}/ci-indicator-values', ['uses' => 'ComponentCiIndicatorValueController@store']);
        $router->post('/{id:[\d]+}/ci-automation-values', ['uses' => 'ComponentCiAutomationValueController@store']);

        $router->post('/{id:[\d]+}/process-phases', ['uses' => 'ProcessPhaseController@store']);

    });
});


