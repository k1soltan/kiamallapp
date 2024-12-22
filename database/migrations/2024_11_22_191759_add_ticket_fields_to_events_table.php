<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('ticket_capacity')->default(0); // Total tickets
            $table->integer('tickets_sold')->default(0);    // Tickets sold
            $table->decimal('ticket_price', 8, 2)->nullable(); // Ticket price
        });
        
    }
};
