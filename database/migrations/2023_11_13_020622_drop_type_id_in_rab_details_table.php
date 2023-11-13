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
        Schema::table('rab_details', function (Blueprint $table) {
            $table->dropForeign('rab_details_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rab_details', function (Blueprint $table) {
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
        });
    }
};
