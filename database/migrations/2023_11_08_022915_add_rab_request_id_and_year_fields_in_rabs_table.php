<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->foreignId('rab_request_id')->after('id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('year')->after('rab_request_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rabs', function (Blueprint $table) {
            $table->dropForeign('rabs_rab_request_id_foreign');
            $table->dropColumn('rab_request_id');
            $table->dropColumn('year');
        });
    }
};
