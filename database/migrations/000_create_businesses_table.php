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
        Schema::create('businesses', function (Blueprint $table) {
            $table->string('id')->primary();
            // Basic Info
            $table->string('name');
            $table->string('slug')->unique();

            // Contact
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            // Address
            $table->string('country')->default('Kenya');
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            // Branding
            $table->string('logo_url')->nullable();

            // Financial Info
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();

            $table->string('mpesa_paybill')->nullable();
            $table->string('mpesa_account_number')->nullable();
            $table->string('mpesa_till_no')->nullable();

            // Extra
            $table->string('industry')->nullable();
            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->string('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('businesses');
    }
};
