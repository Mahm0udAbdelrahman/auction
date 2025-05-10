<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Insurance;
use Illuminate\Console\Command;

class FinishInsuranceYearly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:finish-insurance-yearly';

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
        $oneYearAgo = Carbon::now()->subYear();

        $insurances = Insurance::whereHas('user', function ($query) {
            $query->where('service', 'dealer')->where('category', 'dealer');
        })->where('created_at', '<=', $oneYearAgo)->get();

        $count = $insurances->count();

        foreach ($insurances as $insurance) {
            $insurance->delete();
        }

        $this->info("$count yearly insurances deleted.");
    }
}
