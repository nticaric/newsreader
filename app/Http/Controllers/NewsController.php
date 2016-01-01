<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\NewsScrapers\JutarnjiScraper;

class NewsController extends BaseController
{
    public function jutarnji(JutarnjiScraper $jutarnji)
    {
        $news = $jutarnji->parseHomePage();
        return view('home', compact('news'));
    }
}
