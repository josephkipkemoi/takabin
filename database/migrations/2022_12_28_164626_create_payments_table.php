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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users');
            $table
                ->unsignedBigInteger('service_id')
                ->references('id')
                ->on('services');
            $table
                ->unsignedBigInteger('collection_id')
                ->references('id')
                ->on('collections');
            $table->string('payment_reference_code')->unique();    
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
        Schema::dropIfExists('payments');
    }
};
