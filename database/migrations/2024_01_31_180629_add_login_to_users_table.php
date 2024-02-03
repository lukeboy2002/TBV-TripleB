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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('logged_in')
                ->after('biography')
                ->default(false);

            $table->datetime('last_login_time')
                ->after('logged_in')
                ->nullable();

            $table->text('last_login_ip')
                ->after('last_login_time')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('logged_in');
            Schema::dropIfExists('last_login_time');
            Schema::dropIfExists('last_login_ip');
        });
    }
};
