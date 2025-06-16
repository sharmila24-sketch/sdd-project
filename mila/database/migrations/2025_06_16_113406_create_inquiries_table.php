<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id('InquiryID');
            $table->unsignedBigInteger('UserID');
            $table->string('InquiryTitle');
            $table->text('InquiryDescription');
            $table->string('InquiryEvidance')->nullable();
            $table->string('InquiryStatus')->default('Pending');
            $table->unsignedBigInteger('AssignedAgency')->nullable();
            $table->dateTime('InquiryDate');
            $table->boolean('is_public');
            $table->string('InquiryCategory');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
};
