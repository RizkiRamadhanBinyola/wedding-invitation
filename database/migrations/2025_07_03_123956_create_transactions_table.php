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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('invitation_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('payment_type')->nullable();
            $table->string('transaction_status')->default('pending');
            $table->string('gross_amount');
            $table->text('response')->nullable(); // optional: simpan JSON response Midtrans
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
