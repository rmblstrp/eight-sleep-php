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
        Schema::create('family_members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('family_admin')->index();
            $table->unsignedBigInteger('family_member')->unique();
            $table->timestamps();

            $table->foreign('family_admin', 'fk_family_admin_user')
                ->references('id')->on('sleep_user')
                ->onUpdate('cascade');
            $table->foreign('family_member', 'fk_family_member_user')
                ->references('id')->on('sleep_user')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_members');
    }
};
