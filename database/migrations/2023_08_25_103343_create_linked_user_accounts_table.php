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
        Schema::create('linked_user_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('originating_user_id')->index();
            $table->unsignedBigInteger('linked_user_id')->index();
            $table->timestamps();

            $table->foreign('originating_user_id', 'fk_originating_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->foreign('linked_user_id', 'fk_linked_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linked_user_accounts');
    }
};
