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
            $table->dropColumn('ticket');
            $table->dropColumn('balance');
            $table->dropColumn('year');
            $table->dropColumn('status');
            $table->foreignId('sub_component_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('program_id')->after('sub_component_id')->constrained()->onDelete('cascade');
            $table->string('description')->after('program_id');
            $table->integer('volume')->after('description');
            $table->string('unit')->after('volume');
            $table->string('total')->after('price');
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
            $table->string('ticket')->after('id');
            $table->string('balance')->after('ticket');
            $table->string('year')->after('balance');
            $table->string('status')->after('year');
            $table->dropForeign('rab_requests_sub_component_id_foreign');
            $table->dropColumn('sub_component_id');
            $table->dropForeign('rab_requests_program_id_foreign');
            $table->dropColumn('program_id');
            $table->dropColumn('description');
            $table->dropColumn('volume');
            $table->dropColumn('unit');
            $table->dropColumn('total');
        });
    }
};
