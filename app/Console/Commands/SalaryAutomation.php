<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SalaryAutomation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automate Salary Based on Date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::today()->day;
        $expense = new Expense;
        $users = User::where('date', $date)->get();
        foreach($users as $user){
            $user->$expense->balance += $user->salary;
        }
    }
}
