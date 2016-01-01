<?php namespace App\NewsScrapers;

use Goutte\Client;
use SimpleXMLElement;
use stdClass;
use DateTime;
use Exception;

class VecernjiScraper {

    public function parseHomePage()
    {
        $client = new Client();

        $url = "http://www.vecernji.hr/rss";
        $crawler = $client->request('GET', $url);

        $news = [];
        $entries = @simplexml_load_file($url);

        foreach ($entries->channel->item as $entry) {
            $n = new stdClass;
            $n->link = $this->prepareLink( (string)$entry->link );
            $n->image = $entry->enclosure['url'];
            $n->category = (string) $entry->category;
            $n->title = (string) $entry->title;
            $n->summary = $this->removeImageFromDesc( (string) $entry->description );
            $n->author  = 'Vecernji.hr';
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

    public function removeImageFromDesc($text)
    {
        //$text = preg_replace("/<img.*?\/>/s", "", $text) ? : $text;
        $text = strip_tags($text);
        return $text;
    }
}