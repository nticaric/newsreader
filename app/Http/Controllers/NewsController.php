<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\NewsScrapers\JutarnjiScraper;

class NewsController extends BaseController
{
    public function jutarnjiHome(JutarnjiScraper $jutarnji)
    {
        $news = $jutarnji->parseHomePage();
        return view('home', compact('news'));
    }

    public function jutarnjiArticle($slug, $id, JutarnjiScraper $jutarnji)
    {
        //get article type
        $articleType = $jutarnji->getArticleType($slug, $id);

        if($articleType == 'gallery') {
            return redirect('/jutarnji/'.$id);
        }

        list($text, $image) = $jutarnji->getArticle($slug, $id);
        return view('single', compact('text', 'image'));
    }

    public function jutarnjiGallery($id, JutarnjiScraper $jutarnji)
    {
        $images = $jutarnji->getGallery($id);
        return view('gallery', compact('images'));
    }
}
