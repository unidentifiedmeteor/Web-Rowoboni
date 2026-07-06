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
    Schema::create('settings', function (Blueprint $table) {
        $table->id();

        $table->string('site_name')->default('Desa Wisata Rowoboni');

        $table->string('email')->nullable();

        $table->string('whatsapp')->nullable();

        $table->text('address')->nullable();

        $table->text('description')->nullable();

        $table->string('bank_name')->nullable();

        $table->string('account_number')->nullable();

        $table->string('account_name')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
