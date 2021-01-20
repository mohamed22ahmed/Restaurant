<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlySubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_subs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subscription');
            $table->bigInteger('client_id');
            $table->integer('price');
            $table->integer('period');
            $table->string('supplier_name');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('monthly_subs');
    }
}
