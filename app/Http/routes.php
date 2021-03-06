<?php

use Symfony\Component\CssSelector\CssSelector;
use Illuminate\Http\Request;
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

$app->get('/', 'NewsController@jutarnjiHome');
$app->get('/jutarnji/{id}', 'NewsController@jutarnjiGallery');
$app->get('/jutarnji/{cat}/{sub}/{slug}/{id}', 'NewsController@jutarnjiArticle');
$app->get('/index.hr/{cat}/{sub}/{slug}/{id}', 'NewsController@indexArticle');

$app->get('/index.hr', 'NewsController@indexHome');

$app->get('/net.hr', 'NewsController@nethrHome');
$app->get('/vijesti.hr', 'NewsController@vijestiHome');
$app->get('/poslovni.hr', 'NewsController@poslovniHome');
