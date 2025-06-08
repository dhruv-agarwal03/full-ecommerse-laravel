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
        Schema::create('customers', function (Blueprint $table) {
            // id	fname	lname	number	password	email	address	city	state	pincode	created_at	

            $table->id();
            $table->fname();
            $table->lname();
            $table->number();
            $table->password();
            $table->email();
            $table->address();
            $table->city();
            $table->state();
            $table->pincode();
            $table->create_at();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
