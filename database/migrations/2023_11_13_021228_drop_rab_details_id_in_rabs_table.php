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
            $table->dropForeign('rabs_rab_request_id_foreign');
            $table->dropColumn('rab_request_id');
            $table->string('ticket')->after('id');
            $table->foreignId('type_id')->after('price')->constrained()->onDelete('cascade');
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
            $table->foreignId('rab_details_id')->constrained()->onDelete('cascade');
            $table->dropColumn('ticket');
            $table->dropForeign('rabs_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
