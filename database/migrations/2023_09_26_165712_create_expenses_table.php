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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->decimal('amount', 10, 2); 
            $table->text('description'); 
            $table->string('category');       
            $table->string('supporting_document')->default("uploads/unavailable.jpg");
            $table->enum('status', ['pending','accepted', 'approved', 'rejected_hod','rejected_manager','drafted'])->default('pending');
            $table->timestamps();


            $table->foreign('staff_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
