<?php

namespace App\Services\Crawler;

use Illuminate\Support\ServiceProvider;
use PHPHtmlParser\Dom;

class CrawlerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('crawler', function () {
            return new Crawler(new Dom());
        });
    }
}
