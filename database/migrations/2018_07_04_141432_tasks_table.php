<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('tasks', function (Blueprint $table) {
          $table->increments('id');
          $table->text('fromLocation');
          $table->text('toLocation');
          $table->date('deliveryDate')->nullable();
          $table->dateTime('startedAt')->nullable();
          $table->dateTime('finishedAt')->nullable();
          $table->text('driverName');
          $table->text('courier');
          $table->text('description')->nullable();
          $table->text('status');
          $table->text('driverComment')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
