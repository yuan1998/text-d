<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->longtext('content')->comment('内容');
            $table->text('summary')->nullable()->comment('摘要');
            $table->text('cover')->nullable()->comment('封面');
            $table->integer('look')->default(0)->comment('浏览');
            $table->string('author')->comment('作者');
            $table->unsignedInteger('cat_id')->comment('分类ID');
            $table->datetime('push_time')->comment('发表时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
