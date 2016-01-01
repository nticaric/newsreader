<?php namespace App\NewsScrapers;

use Goutte\Client;
use SimpleXMLElement;
use stdClass;
use DateTime;

class JutarnjiScraper {

    public function parseHomePage()
    {
        $client = new Client();

        $url = "http://www.jutarnji.hr/rss";
        $crawler = $client->request('GET', $url);

        $news = [];
        $entries = new SimpleXMLElement(file_get_contents($url));

        foreach ($entries as $entry) {
            if($entry->link[2]) {
                $n = new stdClass;
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
        return $news;
    }

    public function prepareLink($text) {
        $text = str_replace("http://www.jutarnji.hr/", '/jutarnji/', $text);
        $text = str_replace('src="/jutarnji', 'src="http://jutarnji.hr', $text);

        //$text = preg_replace("/<script.*?\/script>/s", "", $text) ? : $text;
        return $text;
    }
}