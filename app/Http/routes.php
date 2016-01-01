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
$app->get('/jutarnji/{slug}/{id}', 'NewsController@jutarnjiArticle');

$app->get('/index.hr', 'NewsController@indexHome');

$app->get('/vecernji.hr', 'NewsController@vecernjiHome');