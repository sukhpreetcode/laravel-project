<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient;

class DeleteOldPatients extends Command
{
    protected $signature = 'patients:delete-old';

    protected $description = 'Delete patients whose appointments are finished';

    public function handle()
    {
        $count = Patient::whereNotNull('appointment_at')
            ->where(
                'appointment_at',
                '<',
                now()
            )
            ->delete();

        $this->info(
            "{$count} old patient records deleted."
        );

        return Command::SUCCESS;
    }
}