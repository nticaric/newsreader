<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\NewsScrapers\JutarnjiScraper;
use App\NewsScrapers\IndexScraper;
use App\NewsScrapers\VecernjiScraper;
use App\NewsScrapers\NethrScraper;

class NewsController extends BaseController
{
    public function jutarnjiHome(JutarnjiScraper $scraper)
    {
        $news = $scraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function jutarnjiArticle($cat, $sub, $slug, $id, JutarnjiScraper $scraper)
    {
        //get article type
        $articleType = $scraper->getArticleType($cat, $sub, $slug, $id);

        if($articleType == 'gallery') {
            return redirect('/jutarnji/'.$id);
        }

        if($articleType == 'domidizajn') {
            $images = $scraper->getImagesForDomIDizajn($slug, $id);
            return view('gallery', compact('images'));
        }

        list($text, $image, $title) = $scraper->getArticle($cat, $sub, $slug, $id);
        return view('single', compact('text', 'image', 'title'));
    }

    public function jutarnjiGallery($id, JutarnjiScraper $scraper)
    {
        $images = $scraper->getGallery($id);
        return view('gallery', compact('images'));
    }

    public function indexHome(IndexScraper $scraper)
    {
        $news = $scraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function vecernjiHome(VecernjiScraper $scraper)
    {
        $news = $scraper->parseHomePage();
        return view('home', compact('news'));
    }

    public function nethrHome(NethrScraper $scraper)
    {
        $news = $scraper->parseHomePage();
        return view('home', compact('news'));
    }
}
