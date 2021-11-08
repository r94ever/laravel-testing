<?php

namespace App\Services\Crawler;

use App\Services\Crawler\Actions\StoreCrawledPost;
use App\Services\Crawler\Detectors\CategoryDetector;
use App\Services\Crawler\Detectors\CommentsCountDetector;
use App\Services\Crawler\Detectors\UrlDetector;
use App\Services\Crawler\Detectors\TitleDetector;
use Illuminate\Support\Collection;
use PHPHtmlParser\Dom;

class Crawler
{
    const DETECTORS = [
        'post_url' => UrlDetector::class,
        'title' => TitleDetector::class,
        'category' => CategoryDetector::class,
        'comments_count' => CommentsCountDetector::class
    ];

    const URL = 'https://sample.kan-tek.com/blog.html';

    const POSTS_LIST_WRAPPER_CSS_SELECTOR = '.blog.grid.grid-view';

    const POST_ITEM_WRAPPER_CSS_SELECTOR = '.item.post';

    private $dom;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    public function crawl(int $numOfPosts): Collection
    {
        $htmlDom = $this->dom->loadFromUrl(self::URL);
        $postsListDomNode = $htmlDom->find(self::POSTS_LIST_WRAPPER_CSS_SELECTOR);
        $postItemsDomNode = $postsListDomNode->find(self::POST_ITEM_WRAPPER_CSS_SELECTOR);
        $crawledPosts = collect();

        for ($i = 0; $i < $numOfPosts; $i++) {
            if ($postItemsDomNode[$i] instanceof Dom\Node\HtmlNode) {
                $data = [];

                foreach (self::DETECTORS as $field => $detector) {
                    $data[$field] = (new $detector($postItemsDomNode[$i]))->getContent();
                }

                $crawledPosts->push((new StoreCrawledPost())->handle($data));
            }
        }

        return $crawledPosts;
    }
}
