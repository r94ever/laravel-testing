<?php

namespace App\Services\Crawler\Actions;

use App\Models\CrawledPost;
use Illuminate\Support\Arr;

class StoreCrawledPost
{
    public function handle(array $data)
    {
        return CrawledPost::query()
            ->updateOrCreate(
                ['title' => Arr::get($data, 'title')],
                $data
            );
    }
}
