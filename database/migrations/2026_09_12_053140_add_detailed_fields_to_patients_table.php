<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {

            $table->string('appointment_type')->nullable();

            $table->string('service')->nullable();

            $table->string('body_part')->nullable();

            $table->text('symptoms')->nullable();

            $table->text('medical_history')->nullable();

            $table->text('operation_details')->nullable();

            $table->string('urgency')
                ->default('Normal');

            $table->string('status')
                ->default('Pending');

            $table->text('admin_notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {

            $table->dropColumn([
                'appointment_type',
                'service',
                'body_part',
                'symptoms',
                'medical_history',
                'operation_details',
                'urgency',
                'status',
                'admin_notes',
            ]);

        });
    }
};