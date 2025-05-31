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
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('category_id')->nullable()->default(null);
            $table->date('date');
            $table->decimal('amount', 10);
            $table->string('description', 100);
            $table->text('notes')->nullable()->default(null);
            $table->datetime('created_datetime')->nullable()->default(null);
            $table->datetime('updated_datetime')->nullable()->default(null);
            $table->unsignedBigInteger('created_by_uid')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by_uid')->nullable()->default(null);
            $table->foreign('created_by_uid')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_uid')->references('id')->on('users')->onDelete('set null');
            $table->foreign('account_id')->references('id')->on('cash_accounts')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('cash_transaction_categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_transactions');
    }
};
