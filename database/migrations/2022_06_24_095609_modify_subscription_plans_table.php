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
        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->unsignedBigInteger('messages_per_book')->nullable();
            $table->unsignedBigInteger('convertion_rate')->nullable();
            $table->unsignedBigInteger('pictures_per_book')->nullable();
            $table->unsignedBigInteger('available_templates')->nullable();
            $table->boolean('can_tranfer_book')->default(false);

            $table->unsignedBigInteger('days_to_expiry')->nullable()->change();
            $table->unsignedBigInteger('total_number_books')->default(1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
