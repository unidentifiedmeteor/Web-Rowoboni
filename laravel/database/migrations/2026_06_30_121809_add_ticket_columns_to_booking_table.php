<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {

            $table->string('ticket_code')->nullable()->after('status');

            $table->timestamp('verified_at')->nullable()->after('ticket_code');

            $table->boolean('is_used')->default(false)->after('verified_at');

        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {

            $table->dropColumn([
                'ticket_code',
                'verified_at',
                'is_used'
            ]);

        });
    }
};
