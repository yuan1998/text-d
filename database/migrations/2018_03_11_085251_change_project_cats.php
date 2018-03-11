<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeProjectCats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_cats', function (Blueprint $table) {
            $table->text('treatment')->nullable()->comment('治疗方案');
            $table->text('reason')->nullable()->comment('病发原因');
            $table->text('symptom')->nullable()->comment('症状');
            $table->text('harm')->nullable()->comment('危害');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_cats', function (Blueprint $table) {
            $table->dropColumn('treatment');
            $table->dropColumn('reason');
            $table->dropColumn('symptom');
            $table->dropColumn('harm');
        });
    }
}
