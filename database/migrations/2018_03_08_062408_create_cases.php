<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->increments('id');
            $table->text('cover')->comment('封面');
            $table->string('title')->comment('标题');
            $table->string('project')->comment('项目名称');
            $table->string('desc')->comment('描述');
            $table->unsignedInteger('article_id')->nullable()->comment('文章ID');
            $table->integer('look')->default(0)->comment('查看次数');
            $table->text('link')->nullable()->comment("链接");
            $table->json('image')->nullable()->comment('图片集');
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
        Schema::dropIfExists('cases');
    }
}
