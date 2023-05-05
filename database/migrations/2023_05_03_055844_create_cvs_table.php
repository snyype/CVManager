<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cvs', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("tech");
            $table->string("level");
            $table->string("salaryexp");
            $table->string("exp");
            $table->string("number");
            $table->string("email");
            $table->string("ref");
            $table->string("image");
            $table->string("interviewer")->default("")->nullable();
            $table->string("interviewer_id")->default("")->nullable();
            $table->string("status")->default('submited')->nullable();
            $table->dateTime("datetime")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
