<?php

namespace App\Http\Controllers;

use App\Models\CrawledPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use PHPHtmlParser\Dom;

class ExportPdfController extends Controller
{
    public function __invoke(Request $request, CrawledPost $crawledPost)
    {
//        dd(app('pdfconverter'));
//        $html = file_get_contents($crawledPost->post_url);
//
//        $pdf = App::make('dompdf.wrapper');
//        $pdf->loadHTML($html);
        return app('pdfconverter')->from($crawledPost->post_url)->convert()->download($crawledPost->getKey());

//        return $pdf->download('1.pdf');
    }
}
