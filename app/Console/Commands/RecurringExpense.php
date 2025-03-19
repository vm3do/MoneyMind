<?php

namespace App\Console\Commands;

use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecurringExpense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'paying recurring expenses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->day;
        $users_autopays = Expense::with('user')
                        ->where('is_recurring', true)
                        ->whereDay('date', $today)
                        ->get();

        foreach($users_autopays as $autopay){
            if($autopay->user){
                $autopay->user->balance -= $autopay->amount;
                $autopay->user->save();
            }
        }; 
    }
}
