<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsUbicationRequestRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requests_restaurants', function (Blueprint $table) {
            $table->char('ruc',11);
            $table->float('latitude',10,7)->nulleable();
            $table->float('longitude',10,7)->nulleable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requests_restaurants', function (Blueprint $table) {
            $table->dropColumn('ruc');
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
}
