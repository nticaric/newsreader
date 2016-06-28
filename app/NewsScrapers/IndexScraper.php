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
        $text = str_replace("http://www.index.hr/", '/index.hr/', $text);
        $text = str_replace('src="/index.hr', 'src="http://index.hr', $text);

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

    public function getArticle($cat, $sub, $slug, $id)
    {
        $url     = "http://www.index.hr/{$cat}/{$sub}/{$slug}/{$id}";
        $client  = new Client();
        $crawler = $client->request('GET', $url);

        $text  = $this->prepareLink($crawler->filter('#article_text')->html());
        $image = $crawler->filter("meta[property='og:image']")->attr('content');
        $title = $crawler->filter("meta[property='og:title']")->attr('content');
        $meta = [];
        try {
            $meta['pictureAuthor'] = $crawler->filter('.picture-author')->text();
        } catch (Exception $e) {
            $meta['pictureAuthor'] = "";
        }
        try {
            $meta['pictureCaption'] = $crawler->filter('.picture-caption')->text();
        } catch (Exception $e) {
            $meta['pictureCaption'] = "";
        }

        try {
            $meta['author'] = $crawler->filter(".writer strong")->text();
        } catch (Exception $e) {
            $meta['author'] = "";
        }

        try {
            $meta['category'] = $crawler->filter("body")->attr('data-category');            
        } catch (Exception $e) {
            $meta['category'] = "Vijesti"; 
        }
        try {
            $meta['published'] = $crawler->filter('.published-date')->text();
            $meta['published'] = (new DateTime($meta['published']))->format("d M G:i");
        } catch (Exception $e) {
            $meta['published'] = "";
        }
        return [$text, $image, $title, $meta];
    }
}