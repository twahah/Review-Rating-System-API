<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->foreignId('gig_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['gig_id', 'user_id']); // One review per user per gig
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};