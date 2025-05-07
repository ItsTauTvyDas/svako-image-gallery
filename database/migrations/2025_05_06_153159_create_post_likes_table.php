<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('post_likes', function (Blueprint $table) {
            $table->foreignId('post_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->primary(['post_id', 'user_id']);
            $table->timestamp('created_at')
                  ->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_likes');
    }
};
