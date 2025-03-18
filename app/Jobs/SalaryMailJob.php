<?php

namespace App\Jobs;

use App\Mail\SalaryMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SalaryMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    private $user;

    public function __construct($user)
    {
        $this->user = $user
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new SalaryMail($this->user))
    }
}
