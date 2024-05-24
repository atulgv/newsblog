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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('image');
            $table->string('date')->default(date("d-m-Y"));
            $table->unsignedBigInteger('person');
            $table->foreign('person')->references('person_id')->on('persons')->cascadeOnDelete();
            $table->unsignedBigInteger('category');
            $table->foreign('category')->references('category_id')->on('categories')->cascadeOnDelete();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
