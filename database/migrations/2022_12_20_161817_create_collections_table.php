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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('user_id')
                ->references('id')
                ->on('users');
            $table->string('collection_id');
            $table->unsignedBigInteger('collector_id')->nullable();
            $table->boolean('collected')->default(false);
            $table->timestamp('estimate_collection_time')->nullable();
            $table->timestamp('collection_collected_at')->nullable();
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
        Schema::dropIfExists('collections');
    }
};
