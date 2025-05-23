<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->foreignId('following_user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->foreignId('followed_user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->primary(['following_user_id', 'followed_user_id']);
            $table->timestamp('created_at')
                  ->useCurrent();;
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
