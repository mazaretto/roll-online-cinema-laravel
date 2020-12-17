<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('films', function (Blueprint $table) {
      $table->id();
      $table->text('title');
      $table->longText('image')->nullable();
      $table->longText('description')->nullable();
      $table->text('genres')->nullable();
      $table->longText('keys')->nullable();
      $table->text('alias_start')->nullable();
      $table->text('alias_chill')->nullable();
      $table->text('alias_ivi')->nullable();
      $table->text('alias_megogo')->nullable();
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
    Schema::dropIfExists('films');
  }
}
