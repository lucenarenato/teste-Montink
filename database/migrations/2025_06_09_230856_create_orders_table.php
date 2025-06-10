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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable(); // identifica carrinho não logado
            $table->unsignedBigInteger('user_id')->nullable();
            $table->enum('status', [
                'CARRINHO',
                'AGUARDANDO_PAGAMENTO',
                'CANCELADO',
                'PAGAMENTO_REALIZADO',
                'ENTREGUE'
            ])->default('CARRINHO');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('freight', 10, 2); //frete
            $table->decimal('total', 10, 2);
            $table->string('cep');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
