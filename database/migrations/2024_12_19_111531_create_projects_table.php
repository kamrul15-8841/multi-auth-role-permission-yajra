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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['web', 'mobile']);
            $table->enum('stack', ['full-stack-mern', 'full-stack-laravel', 'full-stack-laravel-react', 'full-stack-mobile', 'front-end', 'back-end', 'mobile']);
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('github_link')->nullable();
            $table->string('web_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
