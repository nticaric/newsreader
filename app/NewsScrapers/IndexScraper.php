<?php namespace App\NewsScrapers;

use Goutte\Client;
use SimpleXMLElement;
use stdClass;
use DateTime;
use Exception;

class IndexScraper {

    public function parseHomePage()
    {
        $client = new Client();

        $url = "http://www.index.hr/vijesti/rss.ashx";
        $crawler = $client->request('GET', $url);

        $news = [];
        $entries = @simplexml_load_file($url);

        foreach ($entries->channel->item as $entry) {
                $n = new stdClass;
                $n->link = $this->prepareLink( (string)$entry->link );
                $n->image = $this->exstractImage((string) $entry->description);
                $n->category = 'Vijesti';
                $n->title = (string) $entry->title;
                $n->summary = $this->removeImageFromDesc( (string) $entry->description );
                $n->author  = 'Index.hr';
                $n->updated  = (new DateTime($entry->pubDate))->format("d M G:i");
                $news[] = $n;

        }
        return $news;
    }

    public function prepareLink($text) {
        //$text = str_replace("http://www.index.hr/", '/index.hr/', $text);
        //$text = str_replace('src="/index.hr', 'src="http://index.hr', $text);

        //$text = preg_replace("/<script.*?\/script>/s", "", $text) ? : $text;
        return $text;
    }

    public function exstractImage($html)
    {
        preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $html, $urls);
        $img = "";
        if(isset($urls[1])) {
            foreach ($urls[1] as $m) {
               $img = $m;
            }
        }
        if($img) {
            $img = str_replace('thumbnail.ashx?path=', '', $img);
            $img = substr($img, 0, strpos($img, "&"));
            return $img;
        }
        return "";
    }

    public function removeImageFromDesc($text)
    {
        //$text = preg_replace("/<img.*?\/>/s", "", $text) ? : $text;
        $text = strip_tags($text);
        return $text;
    }
}