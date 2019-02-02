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

$router->get('/news', ['uses' => 'NewsController@getNews']);
$router->post('/news/save', ['uses' => 'NewsController@postCreateNews']);
$router->post('/news/save/{id}', ['uses' => 'NewsController@postCreateNews']);
$router->post('/news/delete/{id}', ['uses' => 'NewsController@postDeleteNews']);


$router->get('/topic', ['uses' => 'TopicController@getTopic']);
$router->post('/topic/save', ['uses' => 'TopicController@postCreateTopic']);
$router->post('/topic/save/{id}', ['uses' => 'TopicController@postCreateTopic']);
$router->post('/topic/delete/{id}', ['uses' => 'TopicController@postDeleteTopic']);
