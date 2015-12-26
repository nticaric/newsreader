<?php

use Goutte\Client;
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

    $text = prepareLink($crawler->filterXPath('//*[@class="dr_article"]')->html());
    $image = $crawler->filterXPath('//*[@id="foto"]/ul/li/div[1]/img')->attr('src');
    return view('single', compact('text', 'image'));
});

$app->get('/', function ()  {
    $client = new Client();

    $url = "http://www.jutarnji.hr/rss";
    $crawler = $client->request('GET', $url);

    $news = [];
    $entries = new SimpleXMLElement(file_get_contents($url));

    foreach ($entries as $entry) {
        if($entry->link[2]) {
            $n = new stdClasS;
            $n->link = prepareLink( (string)$entry->link[0]['href'] );
            $n->image = (string)$entry->link[2]['href'];
            $n->category = (string)$entry->category[0]['term'];
            $n->title = (string) $entry->title;
            $n->summary = (string) $entry->summary;
            $n->author  = $entry->author->name;
            $n->updated  = (new DateTime($entry->updated))->format("d M G:i");
            $news[] = $n;
        }

    }
    return view('home', compact('news'));
});

function prepareLink($text) {
    $text = str_replace("http://www.jutarnji.hr/", '/jutarnji/', $text);
    $text = str_replace('src="/jutarnji', 'src="http://jutarnji.hr', $text);
    return $text;
}
function customTrim($str) {
    $str = str_replace("&nbsp;", '', $str);
    $str = str_replace("&#160;", "", $str);
    $str = trim($str);
    $str = trim($str, "\xC2\xA0");
    return $str;
}