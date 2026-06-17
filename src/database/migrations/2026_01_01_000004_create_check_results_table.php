<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('check_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('check_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->unsignedSmallInteger('status_code')->nullable();
            $table->unsignedInteger('response_time')->nullable();
            $table->string('error')->nullable();
            $table->timestamps();
            $table->index(['check_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('check_results');
    }
};
