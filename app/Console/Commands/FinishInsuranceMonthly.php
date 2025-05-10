<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Insurance;
use Illuminate\Console\Command;

class FinishInsuranceMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:finish-insurance-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oneMonthAgo = Carbon::now()->subMonth();

        $insurances = Insurance::whereHas('user', function ($query) {
            $query->where('service', 'my')->where('category', 'my');
        })->where('created_at', '<=', $oneMonthAgo)->get();

        $count = $insurances->count();

        foreach ($insurances as $insurance) {
            $insurance->delete();
        }

        $this->info("$count monthly insurances deleted.");
    }
}
