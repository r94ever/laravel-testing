<?php

namespace App\Services\PdfConverter;

use Illuminate\Support\Facades\App;

class PdfConverter
{
    private string $url;

    private string $html;

    private string $baseUrl;

    public function from(string $url)
    {
        $this->url = $url;
        $this->html = file_get_contents($this->url);
        $this->baseUrl = parse_url($this->url, PHP_URL_SCHEME)
            .'://'
            .parse_url($this->url, PHP_URL_HOST)
            .'/';

        return $this;
    }

    public function convert()
    {
        $this->replaceStyleSheetLink()
            ->replaceImageSrc();

        return $this;
    }

    private function replaceStyleSheetLink()
    {
        $this->html = preg_replace(
            '/<link[^>]+href="([^">]+)"/',
            '<link rel="stylesheet" href="'.$this->baseUrl.'$1"',
            $this->html
        );

        return $this;
    }

    private function replaceImageSrc()
    {
        $this->html = preg_replace(
            '/<img[^>]+src="([^">]+)"/',
            '<img src="'.$this->baseUrl.'"',
            $this->html
        );

        return $this;
    }

    public function download(string $fileName)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->html);

        return $pdf->download($fileName.'.pdf');
    }
}
