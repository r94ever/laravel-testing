<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawledPost extends Model
{
    use HasFactory;

    protected $table = 'crawled_posts';

    public $timestamps = false;

    protected $fillable = [
        'comments_count',
        'title',
        'post_url',
        'crawled_at',
        'category'
    ];

    protected $casts = [
        'comments_count' => 'integer',
        'crawled_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->crawled_at = now();
        });
    }
}
