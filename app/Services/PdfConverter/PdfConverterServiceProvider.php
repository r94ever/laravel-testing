<?php

namespace App\Services\PdfConverter;

use Illuminate\Support\ServiceProvider;

class PdfConverterServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('pdfconverter', PdfConverter::class);
    }
}
