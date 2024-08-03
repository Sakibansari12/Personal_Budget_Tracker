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
            $table->integer('user_id')->default(0);
            $table->string('description');
            $table->decimal('amount', 8, 2);
            $table->date('date');
            $table->enum('type', ['income', 'expense']);
            $table->integer('category_id')->default(0);
            $table->softDeletesTz();
            $table->index('deleted_at');
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
