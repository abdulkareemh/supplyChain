<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone');
            $table->integer('number_of_orders')->default(0);
            $table->integer('balance')->default(0);
            $table->string('name');
            $table->enum('status', ['pending', 'active', 'ban'])->default('pending');

            $table->string('product_list')->default('[]');

            $table->string('city')->nullable();
            $table->string('regien')->nullable();
            $table->string('street')->nullable();
            $table->string('description')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
