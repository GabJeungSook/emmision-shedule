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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id');
            $table->string('amount');
            $table->string('payment_method');
            $table->text('attachment')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->integer('hour');
            $table->string('transaction_number');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
