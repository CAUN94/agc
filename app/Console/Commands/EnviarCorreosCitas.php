<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class EnviarCorreosCitas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:correos:citas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía correos a usuarios con citas hace más de 3 meses';

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
        $fechaLimite = now()->subMonths(4);

        $users = User::all();
        $count = 0;
        foreach ($users as $user) {
            $lastAppointment = $user->lastappointment();

            // si lastappointment es null continue
            if (!$lastAppointment) {
                continue;
            }

            // cuenta cuanttos usuarios tienen una cita hace más de 3 meses

            

            if ($lastAppointment && $lastAppointment->Fecha < $fechaLimite) {
                // muestra el rut,nombre y fecha del usuario usando this info
                $this->info("Rut: $user->rut, Nombre: $user->name, Fecha: $lastAppointment->Fecha");

                $count++;
                // Aquí puedes enviar el correo al usuario
                // Utiliza la información de $user y $lastAppointment para construir el correo
            }

            // muuestra el total de usuariois
            
        }
        $this->info("Total de usuarios: $count");
    }
}
