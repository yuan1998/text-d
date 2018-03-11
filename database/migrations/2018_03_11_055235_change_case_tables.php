<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->unsignedInteger('project_id')->nullable()->comment('项目分类Id');
            $table->text('expert_desc')->nullable()->comment("专家描述");
            $table->unsignedInteger('expert_id')->nullable()->comment('专家Id');
            $table->string('name')->nullable()->comment('名称');
            $table->string('sex')->nullabel()->default('male')->comment('性别');
            $table->text('before_img')->nullable()->comment('之前照片');
            $table->text('after_img')->nullable()->comment('之后照片');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropColumn('project_id');
            $table->dropColumn('expert_id');
            $table->dropColumn('expert_desc');
            $table->dropColumn('name');
            $table->dropColumn('sex');
            $table->dropColumn('before_img');
            $table->dropColumn('after_img');
        });
    }
}
