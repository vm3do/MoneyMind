<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:balance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the user balance on the salary day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today()->day;

        $users = User::where('salary_date', $today)->get();
        foreach($users as $user){
            $user->balance += $user->salary;
            $user->save();
        }

        return info('Balance is updated');

    }
}
