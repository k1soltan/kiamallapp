<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('events', function (Blueprint $table) {
        $table->string('type', 255)->change(); // Ensure 'type' is a string with sufficient length
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->string('type', 50)->change(); // Rollback to previous state if necessary
    });
}
};
