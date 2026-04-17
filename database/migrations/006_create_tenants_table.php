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
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // // Rental Info
            // $table->string('unit_number')->nullable();
            // $table->decimal('rent_amount', 10, 2)->nullable();

            // // Lease
            // $table->date('lease_start')->nullable();
            // $table->date('lease_end')->nullable();

            // Emergency (Tenant-specific extra)
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
