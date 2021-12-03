<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->string('business_name');
            $table->string('address_name');
            $table->string('person_in_charge');
            $table->string('person_in_charge_position');
            $table->string('email');
            $table->string('office_phone_number', 10);
            $table->string('personal_phone_number', 10);
            $table->string('commercial_business');
            $table->string('zip_code', 10);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
