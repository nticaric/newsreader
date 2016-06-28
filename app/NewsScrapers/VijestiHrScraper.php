<?php namespace App\NewsScrapers;

use DateTime;
use Goutte\Client;
use stdClass;

class VijestiHrScraper
{

    public function parseHomePage()
    {
        $client = new Client();

        $url     = "http://www.vijesti.rtl.hr/feed";
        $crawler = $client->request('GET', $url);

        $news    = [];
        $entries = @simplexml_load_file($url);

        foreach ($entries->channel->item as $entry) {
            $n           = new stdClass;
            $n->link     = $this->prepareLink((string) $entry->link);
            $n->image    = $entry->image;
            $n->category = (string) $entry->category;
            $n->title    = (string) $entry->title;
            $n->summary  = $this->removeImageFromDesc((string) $entry->content);
            $n->author   = $entry->author;
            $n->updated  = (new DateTime($entry->pubDate))->format("d M G:i");
            $news[]      = $n;
        }
        return $news;
    }

    public function prepareLink($text)
    {
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
