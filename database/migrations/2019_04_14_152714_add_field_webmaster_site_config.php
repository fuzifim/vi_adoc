<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldWebmasterSiteConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_config', function($table) {
            $table->string('webmaster_tools',255)->nullable()->after('site_lang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_config', function (Blueprint $table) {
            $table->dropColumn('webmaster_tools');
        });
    }
}
