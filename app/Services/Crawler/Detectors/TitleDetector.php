<?php

namespace App\Services\Crawler\Detectors;

use App\Services\Crawler\Interfaces\DetectorInterface;
use PHPHtmlParser\Dom\Node\HtmlNode;

class TitleDetector implements DetectorInterface
{
    const SELECTOR = '.link-dark';

    private HtmlNode $node;

    public function __construct(HtmlNode $node)
    {
        $this->node = $node;
    }

    public function getContent()
    {
        return $this->node->find(self::SELECTOR)->innerText;
    }
}
