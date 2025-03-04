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
        Schema::create('books', function (Blueprint $table){
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('publication_year');
            $table->integer('number_pages');
            $table->integer('actual_page');
            $table->longText('image')->charset('binary')->default(null);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
