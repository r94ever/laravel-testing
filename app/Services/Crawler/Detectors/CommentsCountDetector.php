<?php

namespace App\Services\Crawler\Detectors;

use App\Services\Crawler\Interfaces\DetectorInterface;
use PHPHtmlParser\Dom\Node\HtmlNode;

class CommentsCountDetector implements DetectorInterface
{
    const SHOULD_REMOVE_STRING = 'Comment Count : ';

    private HtmlNode $node;

    public function __construct(HtmlNode $node)
    {
        $this->node = $node;
    }

    public function getContent()
    {
        $text = $this->node->find('.post-comments')->find('a')->innerText;

        return str_replace(self::SHOULD_REMOVE_STRING, '', $text);
    }
}
