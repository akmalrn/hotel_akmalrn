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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category_blog')->onDelete('cascade')->onUpdate('cascade');
            $table->string('image');
            $table->string('title');
            $table->string('overview');
            $table->text('description');
            $table->text('meta_keywords');
            $table->text('meta_descriptions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
