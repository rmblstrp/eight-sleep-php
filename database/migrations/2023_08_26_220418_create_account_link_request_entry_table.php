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
        Schema::create('account_link_request_entry', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requesting_user_id');
            $table->unsignedBigInteger('invited_user_id');
            $table->timestamps();

            $table->foreign('requesting_user_id', 'fk_requesting_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
            $table->foreign('invited_user_id', 'fk_invited_user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade');
        });
    }

    /**
     *Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_link_request_entry');
    }
};
