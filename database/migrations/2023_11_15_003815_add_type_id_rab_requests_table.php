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
        Schema::table('rab_requests', function (Blueprint $table) {
            $table->dropForeign('rab_requests_program_id_foreign');
            $table->dropColumn('program_id');
            $table->foreignId('type_id')->after('sub_component_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rab_requests', function (Blueprint $table) {
            $table->dropForeign('rab_requests_type_id_foreign');
            $table->dropColumn('type_id');
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
        });
    }
};
