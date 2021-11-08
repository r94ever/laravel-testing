<?php

namespace App\Http\Controllers;

use App\Models\CrawledPost;
use Illuminate\Http\Request;

class ExportPdfController extends Controller
{
    public function __invoke(Request $request, CrawledPost $crawledPost)
    {
        return app('pdfconverter')
            ->from($crawledPost->post_url)
            ->convert()
            ->download($crawledPost->getKey());
    }
}
