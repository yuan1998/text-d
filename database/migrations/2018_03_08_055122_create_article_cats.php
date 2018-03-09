<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_cats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('标题');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级分类ID');
            $table->text('desc')->comment('描述');
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
        Schema::dropIfExists('article_cats');
    }
}
