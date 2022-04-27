<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\RenewPlan;
use Illuminate\Support\Facades\Mail;

class CheckPaysDailyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:CheckDailyPay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail To All User with no renovation';

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
        $users = [];
        foreach(User::all() as $user){
            if($user->isStudent()){
                if($user->students->first()->settled == 0){
                    $users[] = $user;
                }
            }

        }
        if(count($users)>0){
            return $this->payEmail($users);
        } else {
            $this->info('No pays required');
        }
    }

    protected function payEmail($users){
        foreach($users as $user){
            \Mail::to($user->email)->send(new RenewPlan($user->id));
        }
        $this->info('The emails are send successfully!');
    }
}
