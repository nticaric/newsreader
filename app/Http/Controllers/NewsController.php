<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\NewsScrapers\JutarnjiScraper;
use App\NewsScrapers\IndexScraper;
use App\NewsScrapers\VecernjiScraper;
use App\NewsScrapers\NethrScraper;

class NewsController extends BaseController
{
    public function jutarnjiHome(JutarnjiScraper $sraper)
    {
        $news = $sraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function jutarnjiArticle($slug, $id, JutarnjiScraper $sraper)
    {
        //get article type
        $articleType = $sraper->getArticleType($slug, $id);

        if($articleType == 'gallery') {
            return redirect('/jutarnji/'.$id);
        }

        list($text, $image) = $sraper->getArticle($slug, $id);
        return view('single', compact('text', 'image'));
    }

    public function jutarnjiGallery($id, JutarnjiScraper $sraper)
    {
        $images = $sraper->getGallery($id);
        return view('gallery', compact('images'));
    }

    public function indexHome(IndexScraper $sraper)
    {
        $news = $sraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function vecernjiHome(VecernjiScraper $sraper)
    {
        $news = $sraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function nethrHome(NethrScraper $sraper)
    {
        $news = $sraper->parseHomePage();
        return view('home', compact('news'));
    }
}
