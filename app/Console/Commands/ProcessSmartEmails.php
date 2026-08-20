<?php

namespace App\Console\Commands;

use App\Services\SmartEmailAutomationService;
use Illuminate\Console\Command;
use Throwable;

class ProcessSmartEmails extends Command
{
    protected $signature = 'smart-email:process';

    protected $description =
        'Process intelligent email automation for leads and users';

    public function handle(
        SmartEmailAutomationService $automation
    ): int {

        $this->info('Starting smart email automation...');

        try {

            $automation->process();

            $this->info(
                'Smart email automation completed successfully.'
            );

            return self::SUCCESS;

        } catch (Throwable $e) {

            $this->error(
                'Smart email automation failed: '
                . $e->getMessage()
            );

            report($e);

            return self::FAILURE;
        }
    }
}