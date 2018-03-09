<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->comment('标题');
            $table->string('name')->comment('名称');
            $table->string('location')->comment('位置');
            $table->string('lng')->comment('经度');
            $table->string('lat')->comment('纬度');
            $table->text('bus')->comment('公交线路');
            $table->text('subway')->comment('地铁线路');
            $table->string('open_time')->comment('门诊时间');
            $table->string('contact')->comment('电话');
            $table->text('desc')->comment('描述');
            $table->string('qq')->comment('qq');
            $table->string('wechat')->comment('微信');
            $table->text('wechat_QRcode')->comment('微信二维码');
            $table->text('weibo_QRcode')->comment('微博二维码');
            $table->string('weibo')->comment('微博');
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
        Schema::dropIfExists('hospitals');
    }
}
