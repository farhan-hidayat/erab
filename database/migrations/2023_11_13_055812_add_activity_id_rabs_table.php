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
            $table->foreignId('activity_id')->after('user_id')->constrained()->onDelete('cascade');
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
            $table->dropForeign('rabs_activity_id_foreign');
            $table->dropColumn('activity_id');
        });
    }
};
