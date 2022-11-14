<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('author_id');
            $table->string('title', 100);
            $table->string('slug', 100);
            $table->string('availability', 100);
            $table->string('price', 100)->nullable();
            $table->string('rating', 100)->nullable();
            $table->string('publisher', 100)->nullable();
            $table->string('country_of_publisher', 100)->nullable();
            $table->string('isbn', 100)->nullable();
            $table->string('isbn-10', 100)->nullable();
            $table->string('audience', 100)->nullable();
            $table->string('format', 100)->nullable();
            $table->string('language', 100)->nullable();
            $table->string('total_pages', 100)->nullable();
            $table->string('downloaded', 100)->nullable();
            $table->string('edition_number', 100)->nullable();
            $table->string('recommended', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('book_img', 200);
            $table->string('book_upload', 200);
            $table->string('status', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
