<?php

namespace App\Services\Crawler\Detectors;

use App\Services\Crawler\Interfaces\DetectorInterface;
use PHPHtmlParser\Dom\Node\HtmlNode;

class UrlDetector implements DetectorInterface
{
    const SELECTOR = '.link-dark';

    const BASEURL = 'https://sample.kan-tek.com/';

    private HtmlNode $node;

    public function __construct(HtmlNode $node)
    {
        $this->node = $node;
    }

    public function getContent()
    {
        $url = $this->node->find(self::SELECTOR)->getAttribute('href');

        return self::BASEURL.$url;
    }
}
