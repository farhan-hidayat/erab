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
            $table->dropColumn('ticket');
            $table->dropForeign('rabs_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('rabs_component_id_foreign');
            $table->dropColumn('component_id');
            $table->dropForeign('rabs_type_id_foreign');
            $table->dropColumn('type_id');
            $table->dropColumn('description');
            $table->dropColumn('volume');
            $table->dropColumn('frequency');
            $table->dropColumn('balance');
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
            $table->string('ticket');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('component_id')->constrained()->onDelete('cascade');
            $table->foreignId('type_id')->constrained()->onDelete('cascade');
            $table->string('description');
            $table->integer('volume');
            $table->integer('frequency');
            $table->integer('balance');
        });
    }
};
