<?php namespace App\NewsScrapers;

use DateTime;
use Exception;
use Goutte\Client;
use SimpleXMLElement;
use stdClass;

class JutarnjiScraper
{

    public function parseHomePage()
    {
        $client = new Client();

        $url     = "http://www.jutarnji.hr/rss?type=all";
        $crawler = $client->request('GET', $url);

        $news    = [];
        $entries = new SimpleXMLElement(file_get_contents($url));

        foreach ($entries->entry as $entry) {
            $n           = new stdClass;
            $n->link     = $this->prepareLink((string) $entry->link[0]['href']);
            $n->image    = $this->getImageFromEntry($entry);
            $n->category = (string) $entry->category[0]['term'];
            $n->title    = (string) $entry->title;
            $n->summary  = (string) $entry->summary;
            $n->author   = $entry->author->name;
            $n->updated  = (new DateTime($entry->updated))->format("d M G:i");
            $news[]      = $n;
        }
        return $news;
    }

    public function getArticle($cat, $sub, $slug, $id)
    {
        $url     = "http://www.jutarnji.hr/{$cat}/{$sub}/{$slug}/{$id}/";
        $client  = new Client();
        $crawler = $client->request('GET', $url);

        $text  = $this->prepareLink($crawler->filter('.article_body section')->html());
        $image = $crawler->filter('article > div > div > img')->attr('src');
        $image = str_replace('WIDE_380', 'WIDE_1080', $image);
        $title = $crawler->filter('.container section h1')->text();
        $meta = [];
        try {
            $meta['pictureAuthor'] = $crawler->filter('.picture-author')->text();
        } catch (Exception $e) {
            $meta['pictureAuthor'] = "";
        }
        try {
            $meta['pictureCaption'] = $crawler->filter('.picture-caption ')->text();
        } catch (Exception $e) {
            $meta['pictureCaption'] = "";
        }

        try {
            $meta['author'] = $crawler->filter("meta[name='twitter:creator']")->attr('content');
        } catch (Exception $e) {
            $meta['author'] = "";
        }

        try {
            $meta['category'] = $crawler->filter("body")->attr('data-category');            
        } catch (Exception $e) {
            $meta['category'] = ""; 
        }
        try {
            $meta['published'] = $crawler->filter('.published-date')->text();
            $meta['published'] = (new DateTime($meta['published']))->format("d M G:i");
        } catch (Exception $e) {
            $meta['published'] = "";
        }
        return [$text, $image, $title, $meta];
    }

    public function getGallery($id)
    {
        $url     = "http://www.jutarnji.hr/" . $id;
        $client  = new Client();
        $crawler = $client->request('GET', $url);
        $newUrl  = $crawler->filterXPath("//meta[@property='og:url']")->attr('content');

        $newUrl = str_replace("?foto=1", "", $newUrl);
        $page   = 1;
        $images = [];
        do {
            $page++;
            try {
                $image   = $crawler->filterXPath('//*[@class="foto"]/a/img')->attr('src');
                $crawler = $client->request('GET', $newUrl . "?foto=$page");
            } catch (Exception $e) {
                $image = null;
            }

            if ($image) {
                $images[] = $image;
            }

        } while ($image);
        return $images;
    }

    public function getImagesForDomIDizajn($slug, $id)
    {
        $url     = "http://www.jutarnji.hr/" . $slug . "/" . $id;
        $client  = new Client();
        $crawler = $client->request('GET', $url);

        $newUrl = $crawler->filterXPath("//meta[@property='og:url']")->attr('content');

        $crawler     = $client->request('GET', $newUrl);
        $galleryLink = $crawler->filterXPath('//*[@class="single-text-gallerylink button"]')->attr('href');

        $crawler = $client->request('GET', $galleryLink);

        $postID        = $crawler->filterXPath('//*[@name="comment_post_ID"]')->attr('value');
        $url           = "http://domidizajn.jutarnji.hr/wp-admin/admin-ajax.php?action=dd_gallery_photos&postid=" . $postID;
        $json          = file_get_contents($url);
        $galleryThumbs = json_decode($json);

        foreach ($galleryThumbs->photos as $thumb) {
            $images[] = $thumb->src;
        }
        return $images;
    }

    public function getArticleType($cat, $sub, $slug, $id)
    {
        $url = "http://www.jutarnji.hr/{$cat}/{$sub}/{$slug}/{$id}/";

        $client  = new Client();
        $crawler = $client->request('GET', $url);
        $newUrl  = $crawler->filterXPath("//meta[@property='og:url']")->attr('content');

        if (strpos($newUrl, '?foto=1') !== false) {
            return 'gallery';
        }

        if (strpos($newUrl, 'domidizajn.jutarnji.hr') !== false) {
            return 'domidizajn';
        }

        return 'regular';
    }

    public function prepareLink($text)
    {
        $text = str_replace("http://www.jutarnji.hr/", '/jutarnji/', $text);
        $text = str_replace('src="/jutarnji', 'src="http://jutarnji.hr', $text);

        //$text = preg_replace("/<script.*?\/script>/s", "", $text) ? : $text;
        return $text;
    }

    public function customTrim($str)
    {
        $str = str_replace("&nbsp;", '', $str);
        $str = str_replace("&#160;", "", $str);
        $str = trim($str);
        $str = trim($str, "\xC2\xA0");
        return $str;
    }

    public function getImageFromEntry($entry)
    {
        $imageLink = "";
        foreach ($entry->link as $link) {
            if (strpos($link['type'], 'image') !== false) {
                $imageLink = (string) $link['href'];
            }
        }
        return $imageLink;
    }
}
