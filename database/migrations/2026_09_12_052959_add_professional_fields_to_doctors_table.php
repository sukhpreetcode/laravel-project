<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {

            $table->string('qualification')->nullable()->after('email');

            $table->string('experience')->nullable()->after('qualification');

            $table->string('specialist_body_part')->nullable()->after('experience');

            $table->text('bio')->nullable()->after('specialist_body_part');

            $table->string('available_days')->nullable()->after('bio');

            $table->time('available_from')->nullable()->after('available_days');

            $table->time('available_to')->nullable()->after('available_from');

            $table->decimal('consultation_fee', 10, 2)
                ->nullable()
                ->after('available_to');
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'qualification',
                'experience',
                'specialist_body_part',
                'bio',
                'available_days',
                'available_from',
                'available_to',
                'consultation_fee',
            ]);
        });
    }
};