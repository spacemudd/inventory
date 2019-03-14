<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_name');
            $table->string('client_number', 20)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('cr_number', 50)->nullable();
            $table->bigInteger('supervisor_id')->unsigned()->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->timestamps();

            $table->index([
                'client_name',
                'client_number',
                'email',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
}
