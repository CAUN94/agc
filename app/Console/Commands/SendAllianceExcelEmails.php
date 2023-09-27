<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AllianceEmail;
use Excel;
use DB;

class SendAllianceExcelEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ln:alliance-excel-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar correos electrónicos a partir de un archivo Excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Cargar datos desde el archivo Excel
        $data = Excel::toArray(null, storage_path('app/Libro1.xlsx'))[0];

        // Iterar a través de los datos y enviar correos electrónicos
        $i = 0;
        foreach ($data as $row) {
            if($i == 0) {
                $i++;
                continue;
            }
            $allianceName = $row[0];
            $contactName = $row[1];
            $email = $row[2];

            // Personaliza el correo electrónico con los datos del archivo
            $emailData = [
                'allianceName' => $allianceName,
                'contactName' => $contactName,
            ];

            // Envía el correo electrónico
            Mail::to($email)->send(new AllianceEmail($emailData));
            $this->info('Correo electrónico enviado a: '.$email);
        }
    }
}
