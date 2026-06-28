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
        Schema::create('booking', function (Blueprint $table) {

            $table->id('id_booking');

            $table->unsignedBigInteger('destination_id');

            $table->string('nama');

            $table->string('email');

            $table->string('no_hp');

            $table->integer('jumlah_tiket');

            $table->date('tanggal_kunjungan');

            $table->integer('total_harga');

            $table->enum('status', [
                'Pending',
                'Paid',
                'Cancelled'
            ])->default('Pending');

            $table->timestamps();

            $table->foreign('destination_id')
                ->references('id')
                ->on('destinations')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};