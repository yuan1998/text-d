<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteProjectInfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('project_infos');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('project_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id')->comment('项目名称');
            $table->string('title')->nullable()->comment('标题');
            $table->text('treatment')->nullable()->comment('治疗方案');
            $table->text('reason')->nullable()->comment('病发原因');
            $table->text('symptom')->nullable()->comment('症状');
            $table->text('harm')->nullable()->comment('危害');
            $table->json('image')->nullable()->comment('图片组');
            $table->timestamps();
        });
    }
}
