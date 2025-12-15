<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique(); // TRX-123456
            
            // User boleh null (guest), jika user dihapus, transaksi set null atau cascade terserah Anda
            $table->foreignId('user_id')->nullable()->constrained('users'); 
            
            // FIX ERROR DELETE GAME:
            // Tambahkan ->onDelete('cascade') agar saat Game/Item dihapus, riwayat transaksinya ikut terhapus
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            
            $table->string('target_id'); // User ID Game pembeli
            $table->string('server_id')->nullable(); // Zone ID (jika ada)
            
            $table->decimal('amount', 15, 2); // Harga item + fee
            $table->enum('status', ['PENDING', 'PAID', 'FAILED', 'DONE'])->default('PENDING');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};