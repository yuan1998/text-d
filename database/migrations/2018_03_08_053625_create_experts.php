<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->text('cover')->comment('封面');
            $table->unsignedInteger('project_id')->comment('项目Id');
            $table->json('image')->nullable()->comment('图片集');
            $table->string('position')->comment('职位');
            $table->integer('level')->comment('等级');
            $table->text('link')->nullable()->comment('点击链接');
            $table->text('field')->comment('领域');
            $table->text('desc')->comment('介绍');
            $table->text('achievement')->comment('成就');
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
        Schema::dropIfExists('experts');
    }
}
