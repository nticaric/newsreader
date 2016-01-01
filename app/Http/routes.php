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

$app->get('/', 'NewsController@jutarnji');

$app->get('/jutarnji/{id}', function($id){

    $url = "http://www.jutarnji.hr/".$id;
    $client = new Client();
    $crawler = $client->request('GET', $url);
    $newUrl = $crawler->filterXPath("//meta[@property='og:url']")->attr('content');
    $newUrl = str_replace("?foto=1", "", $newUrl);
    $page = 1;
    $images = [];
    do {
        $page++;
        try {
            $image = $crawler->filterXPath('//*[@class="foto"]/a/img')->attr('src');
            $crawler = $client->request('GET', $newUrl."?foto=$page");
        } catch (Exception $e) {
            $image = null;
        }

        if($image) $images[] = $image;
    } while ($image);

    return view('gallery', compact('images'));

});
$app->get('/jutarnji/{slug}/{id}', function($slug, $id, Request $request) {
    $url = "http://www.jutarnji.hr/".$slug."/".$id;
    $client = new Client();
    $crawler = $client->request('GET', $url);
    
    $newUrl = $crawler->filterXPath("//meta[@property='og:url']")->attr('content');

    if (strpos($newUrl,'?foto=1') !== false) {
        return redirect('/jutarnji/'.$id);
    }

    //ako je domidizajn
    if(strpos($newUrl, 'domidizajn.jutarnji.hr') !== false) {
        $crawler = $client->request('GET', $newUrl);
        $galleryLink = $crawler->filterXPath('//*[@class="single-text-gallerylink button"]')->attr('href');
        
        $crawler = $client->request('GET', $galleryLink);

        $postID = $crawler->filterXPath('//*[@name="comment_post_ID"]')->attr('value');
        $url = "http://domidizajn.jutarnji.hr/wp-admin/admin-ajax.php?action=dd_gallery_photos&postid=".$postID;
        $json = file_get_contents($url);
        $galleryThumbs = json_decode($json);

        foreach ($galleryThumbs->photos as $thumb) {
            $images[] = $thumb->src;
        }
        return view('gallery', compact('images'));
    }

    $text = prepareLink($crawler->filterXPath('//*[@class="dr_article"]')->html());
    $image = $crawler->filterXPath('//*[@id="foto"]/ul/li/div[1]/img')->attr('src');
    return view('single', compact('text', 'image'));
});

function prepareLink($text) {
    $text = str_replace("http://www.jutarnji.hr/", '/jutarnji/', $text);
    $text = str_replace('src="/jutarnji', 'src="http://jutarnji.hr', $text);

    //$text = preg_replace("/<script.*?\/script>/s", "", $text) ? : $text;
    return $text;
}
function customTrim($str) {
    $str = str_replace("&nbsp;", '', $str);
    $str = str_replace("&#160;", "", $str);
    $str = trim($str);
    $str = trim($str, "\xC2\xA0");
    return $str;
}