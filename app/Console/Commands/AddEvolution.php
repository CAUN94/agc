<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ActionMl;

class AddEvolution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:AddActionEvolution {date?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Timestamp with evolution to ActionMl table';

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
        // i will give a specific date in format Y-m-d, then you convert to carbon and get the start of month and end of month and get all actions between this dates
        if($this->argument('date') == null){
            $date = strval(\Carbon\Carbon::now()->format('Y-m-d'));
        } else {
            $date = strval(\Carbon\Carbon::create($this->argument('date'))->format('Y-m-d'));
        }

        // Give me all action between the start of month and end of month of date

        $this->info('Date: '.$date);
        // info start of month
        $this->info('Start of Month: '.\Carbon\Carbon::create($date)->startOfMonth());
        // info end of month
        $this->info('End of Month: '.\Carbon\Carbon::create($date)->endOfMonth());

        $actions = ActionMl::whereBetween('Fecha_Realizacion', [\Carbon\Carbon::create($date)->startOfMonth(), \Carbon\Carbon::create($date)->endOfMonth()])->get();


        // Loop al action and update user the function checkEvolution() and update witth the timestamp the evolution column, if the value is false do nothing

        // Count all actions and display

        $this->info('Total Actions: '.count($actions));

        // Count updated actions and display

        $count = 0;
        // sleep 20 second after 100 loops
        $i = 0;
        foreach ($actions as $action) {
            
            $evolution = $action->checkEvolution();
            $this->info(($i+1).') Action: '.$action->Tratamiento_Nr.' - '.$action->Nombre.' '.$action->Apellido.' - '.$action->Fecha_Realizacion.' - '.$action->checkEvolution());
            if($evolution != False){
                $action->evolution = $evolution;
                $count++;
            }

            $action->save();
            $i++;
            if($i == 10){
                $this->info('Sleeping 10 seconds');
                sleep(10);
                $i = 0;
            }
        }

        $this->info('Total Actions Updated: '.$count);
        
    }
}
