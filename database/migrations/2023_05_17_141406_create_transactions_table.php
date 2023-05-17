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
            $table->string('transaction_code');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->text('receiver_address');
            $table->longText('note')->nullable();
            $table->longText('proof_of_payment')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed', 'delivered', 'success']);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('payment_method'); // 1 = COD, 2 = E Money
            $table->integer('total_price');
            $table->integer('shipping_price');
            $table->integer('total_payment');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
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
