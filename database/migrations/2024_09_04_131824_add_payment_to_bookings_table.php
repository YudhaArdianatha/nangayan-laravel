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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('total_room_payment', 10, 2)->after('num_of_rooms')->nullable();
            $table->decimal('total_service_payment', 10, 2)->after('total_room_payment')->nullable();
            $table->decimal('total_payment', 10, 2)->after('total_service_payment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['total_room_payment', 'total_service_payment', 'total_payment', 'status']);
        });
    }
};
