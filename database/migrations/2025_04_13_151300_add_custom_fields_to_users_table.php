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
    Schema::table('users', function (Blueprint $table) {
        $table->string('first_name');
        $table->string('last_name');
        $table->string('user_name')->unique();
        $table->string('ip_address')->nullable();
       $table->string('contact_no', 20)->unique();
        $table->text('address')->nullable();
        $table->tinyInteger('user_role'); // 1 = Client, etc.
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
