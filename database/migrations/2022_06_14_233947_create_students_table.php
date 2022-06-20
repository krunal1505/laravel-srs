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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female']);
            $table->string('email')->unique();
            $table->date('dob');
            $table->string('passport_number');
            $table->string('address1');
            $table->string('address2');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->string('city');
            $table->string('postal_code');
            $table->integer('program_id');
            $table->integer('intake_id');
            $table->string('passport');
            $table->string('ielts');
            $table->string('education_documents');
            $table->string('study_permit')->nullable();
            $table->string('notes')->nullable();
            $table->enum('user_type', ['admin', 'employee', 'agent']);
            $table->enum('status', ['new', 'approved', 'rejected']);
            $table->integer('created_by');
            $table->enum('is_private', ['no', 'yes']);
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
        Schema::dropIfExists('students');
    }
};
