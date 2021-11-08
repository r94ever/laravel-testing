<?php

namespace App\Services\Crawler\Detectors;

use App\Services\Crawler\Interfaces\DetectorInterface;
use PHPHtmlParser\Dom\Node\HtmlNode;

class CategoryDetector implements DetectorInterface
{
    private HtmlNode $node;

    public function __construct(HtmlNode $node)
    {
        $this->node = $node;
    }

    public function getContent()
    {
        return $this->node->find('.post-category .hover')->innerText;
    }
}
