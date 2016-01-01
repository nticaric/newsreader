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
                $n->category = (string)$entry->category[0]['term'];
                $n->title = (string) $entry->title;
                $n->summary = $this->removeImageFromDesc( (string) $entry->description );
                $n->author  = $entry->author->name;
                $n->updated  = (new DateTime($entry->pubDate))->format("d M G:i");
                $news[] = $n;

        }
        return $news;
    }

    public function prepareLink($text) {
        $text = str_replace("http://www.index.hr/", '/index.hr/', $text);
        $text = str_replace('src="/index.hr', 'src="http://index.hr', $text);

        //$text = preg_replace("/<script.*?\/script>/s", "", $text) ? : $text;
        return $text;
    }

    public function exstractImage($html)
    {
        preg_match_all('~<img.*?src=["\']+(.*?)["\']+~', $html, $urls);
        if(isset($urls[1])) {
            $img = $urls[1][0];
            $img = substr($img, 0, strpos($img, "&w="));
            return $img ."&w=640&h=480&o=c";
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