<?php

namespace App\Console\Commands;

use App\Services\Salaries\Calculate;
use Exception;
use Illuminate\Console\Command;

class CalculateSalary extends Command
{
    /**
     * Calculate salaries service instance
     * @var \App\Services\Salaries\Calculate
     */
    private $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salary:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate salaries for employees for current month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Calculate $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->service->handle();
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
