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
        Schema::table('coupons', function (Blueprint $table) {
            $table->decimal('min_purchase', 10, 2)->nullable()->after('value');
            $table->integer('usage_limit')->nullable()->after('min_purchase');
            $table->timestamp('expires_at')->nullable()->after('usage_limit');
            $table->boolean('is_active')->default(true)->after('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn(['min_purchase', 'usage_limit', 'expires_at', 'is_active']);
        });
    }
}; 