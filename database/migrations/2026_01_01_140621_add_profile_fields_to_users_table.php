<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('email');
            $table->date('birthday')->nullable()->after('username');
            $table->string('profile_photo_path')->nullable()->after('birthday');
            $table->text('about_me')->nullable()->after('profile_photo_path');
            $table->boolean('is_admin')->default(false)->after('about_me');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'birthday',
                'profile_photo_path',
                'about_me',
                'is_admin',
            ]);
        });
    }
};
