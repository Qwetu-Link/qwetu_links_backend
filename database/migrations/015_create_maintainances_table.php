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
        Schema::create('maintainances', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('unit_id');
            $table->string('tenant_id')->nullable();
            $table->string('title');
            $table->text('issue');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'resolved'])->default('pending');
            $table->date('reported_date')->nullable();
            $table->date('resolved_date')->nullable(); 
            $table->decimal('cost', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintainances');
    }
};
