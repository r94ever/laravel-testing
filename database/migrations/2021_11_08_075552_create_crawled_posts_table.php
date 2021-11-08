<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawledPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawled_posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_url');
            $table->string('title');
            $table->string('category');
            $table->integer('comments_count')->default(0);
            $table->timestamp('crawled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crawled_posts');
    }
}
