<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',100);
            $table->string('email',100);
            $table->string('address',200);
            $table->string('phone',30);
            $table->text('note',200)->nullable();
            $table->integer('sub_total');
            $table->string('status',100);
            $table->string('payment_method',50);
            $table->string('MaKH',50);
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
        Schema::dropIfExists('customers');
    }
}
