<?php

namespace App\Console\Commands;

use App\Mail\RenewPlan;
use App\Models\CommandSchedule;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckRenewEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:CheckRenew';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew Mail';

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
        $command = new CommandSchedule;
        $command->command = 'CheckRenewEmail';
        $command->save();
        $users = [];
        foreach(User::all() as $user){
            if($user->isStudent()){
                if(!$user->student()->nextPlan()){
                    $now = \Carbon\Carbon::now()->format('Y-m-d');
                    $now_m5 = \Carbon\Carbon::now()->subdays(5)->format('Y-m-d');
                    $now_p5 = \Carbon\Carbon::now()->adddays(5)->format('Y-m-d');
                    $end = \Carbon\Carbon::parse($user->student()->endMonth())->format('Y-m-d');
                    if($now == $end or $now_m5 == $end or $now_p5 == $end){
                        $users[] = $user;
                    }
                }
            }

        }
        if(count($users)>0){
            return $this->renewEmail($users);
        } else {
            $this->info('No renew required');
        }
    }

    protected function renewEmail($users){
        foreach($users as $user){
            \Mail::to($user->email)->send(new RenewPlan($user->id));
        }
        $this->info('The emails are send successfully!');
    }
}
