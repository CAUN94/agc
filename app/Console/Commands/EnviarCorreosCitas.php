<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RecordatorioAtencionMail;

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
        $fechaLimite = now()->subMonths(6);

        $users = User::all();
        // User where rut like 18783405-8
        $users = User::where('rut', '18783405-8')->get();
        $count = 0;
        foreach ($users as $user) {
            $lastAppointment = $user->lastappointment();

            // si lastappointment es null continue
            if (!$lastAppointment) {
                continue;
            }



            // cuenta cuantos usuarios tienen una cita hace más de 6 meses

            if ($lastAppointment->Fecha < $fechaLimite or $user->id == 5807) {
                // muestra el rut,nombre y fecha del usuario usando this info
                $this->info(
                    "Rut: $user->rut, Nombre: $user->name, Apellido: $user->lastname,Mail: $user->email,Fecha:  $lastAppointment->Fecha");
                    // format date
                    
                    // $lastAppointment->Fecha

                $count++;
                // Aquí puedes enviar el correo al usuario
                $nombreUsuario = $user->name . ' ' . $user->lastname;
                Mail::to($user->email)->send(new RecordatorioAtencionMail($nombreUsuario, '10%'));
                $this->info("Correo enviado a $user->name ($user->email)");
            }

            // muestra el total de usuarios
            
        }
        $this->info("Total de usuarios: $count");
    }
}
