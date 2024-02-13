<?php

use App\Models\Post;
use App\Models\User;
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
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Post::class)->index();
//            $table->foreignId('post_id')->references('id')->on('posts')->cascadeOnDelete();
//            $table->foreignId('user_id')->nullable()->references('id')->on('users')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->nullable()->index();
            $table->string('ip_address', 55);
            $table->string('user_agent', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
