<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('appointment_token', 30)
                ->unique()
                ->nullable()
                ->after('id');

            $table->text('patient_message')
                ->nullable()
                ->after('admin_notes');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropUnique(['appointment_token']);

            $table->dropColumn([
                'appointment_token',
                'patient_message',
            ]);
        });
    }
};