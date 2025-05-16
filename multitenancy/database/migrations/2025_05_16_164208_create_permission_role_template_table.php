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
        Schema::create('permission_role_template', function (Blueprint $table) {
            $table->foreignId('role_template_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_template_id')->constrained()->onDelete('cascade');
            $table->primary(['role_template_id', 'permission_template_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_role_template');
    }
};
