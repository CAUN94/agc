<?php

namespace App\Console\Commands;

use App\Models\ActionMl;
use App\Models\Alliance;
use Illuminate\Console\Command;

class CreateAlliance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:CreateAlliance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Alliance from Medilink';

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
        $actions = ActionMl::distinct('Convenio')->get('Convenio');

        foreach ($actions as $key => $value) {
            $Alliance  = Alliance::updateOrCreate(
                [
                    'name' => $value->Convenio,
                ],
                [
                    'desc' => 10,
                ]
            );
        }


    }
}
