<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\BirthdayGreeting;

class BirthdayReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:birthday:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send birthday greeting emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = now()->format('m-d');
        
        $users = User::whereRaw("DATE_FORMAT(birthday, '%m-%d') = ?", [$today])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new BirthdayGreeting($user));
            $this->info("Birthday greeting sent to $user->name ($user->email)");
        }

        // count users
        $count = $users->count();
        $this->info("Total $count birthday greeting sent");
    }
}
