<?php

use App\Models\Agenda;
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
        Schema::create('agenda_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Agenda::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->enum('status', ['attending', 'not_attending', 'maybe'])->default('maybe');
            $table->timestamps();

            $table->unique(['agenda_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_attendances');
    }
};
