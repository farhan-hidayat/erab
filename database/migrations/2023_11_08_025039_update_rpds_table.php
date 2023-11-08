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
        Schema::table('rpds', function (Blueprint $table) {
            $table->dropForeign('rpds_rab_id_foreign');
            $table->dropColumn('rab_id');
            $table->foreignId('rab_request_id')->after('id')->constrained()->onDelete('cascade');
            $table->string('month')->after('balance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rpds', function (Blueprint $table) {
            $table->foreignId('rab_id')->constrained()->onDelete('cascade');
            $table->dropForeign('rpds_rab_request_id_foreign');
            $table->dropColumn('rab_request_id');
            $table->dropColumn('month');
        });
    }
};
