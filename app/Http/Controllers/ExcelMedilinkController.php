<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as ReaderException;
use App\Models\ActionMl;
use App\Models\AppointmentMl;

class ExcelMedilinkController extends Controller
{
    public function excelread_actions()
    {
        return view('admin.readexcel');
    }

    public function excelprocess_actions(Request $request)
    {
        $archivo = $request->file('archivo_excel_actions');

        try {
            // Determinar el tipo de archivo y crear el lector adecuado
            $tipoArchivo = IOFactory::identify($archivo->getPathname());
            $reader = IOFactory::createReader($tipoArchivo);

            $spreadsheet = $reader->load($archivo->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $filas = [];
            $keys = [];
            $firstRow = true;

            foreach ($worksheet->getRowIterator() as $row) {
                $celdaIterator = $row->getCellIterator();
                $celdaIterator->setIterateOnlyExistingCells(false);
                $fila = [];

                foreach ($celdaIterator as $cell) {
                    $fila[] = $cell->getValue();
                }

                if ($firstRow) {
                    $keys = $fila;
                    $firstRow = false;
                } else {
                    $filas[] = array_combine($keys, $fila);
                }
            }

            foreach ($filas as $fila) {
                $new_row = actionMl::updateOrCreate([
                    'Tratamiento_Nr' => $fila['# Tratamiento'],
                    'Prestacion_Nr'=> $fila['Id. Prestacion'],
                ],[
                    'Sucursal'=> $fila['Sucursal'],
                    'Nombre'=>$fila['Nombre paciente'],
                    'Apellido'=>$fila['Apellidos paciente'],
                    'Categoria_Nr' => $fila['Id. Categoria'],
                    'Categoria_Nombre'=> $fila['Nombre Categoria'],
                    'Tratamiento_Nr'=> $fila['# Tratamiento'],
                    'Profesional'=> $fila['Realizado por'],
                    'Estado'=> $fila['Estado de la consulta'],
                    'Convenio'=> $fila['Nombre Convenio'],
                    'Prestacion_Nr'=> $fila['Id. Prestacion'],
                    'Prestacion_Nombre'=> $fila['Nombre Prestacion'],
                    'Fecha_Realizacion'=> $fila['Fecha Realizacion'],
                    'Precio_Prestacion'=> $fila['Precio Prestación'],
                    'Abono'=> $fila['Abonado'],
                    'Total'=> $fila['Total a pagar Profesional'],
                ]);
            }

        } catch (ReaderException $e) {
            // Manejo del error
            return response()->json(['error' => 'Error al leer el archivo: ' . $e->getMessage()], 500);
        }

        return redirect()->back();
    }

    public function excelprocess_appointments(Request $request){
        $archivo = $request->file('archivo_excel_appointments');

        try {
            // Determinar el tipo de archivo y crear el lector adecuado
            $tipoArchivo = IOFactory::identify($archivo->getPathname());
            $reader = IOFactory::createReader($tipoArchivo);

            $spreadsheet = $reader->load($archivo->getPathname());
            $worksheet = $spreadsheet->getActiveSheet();
            $filas = [];
            $keys = [];
            $firstRow = true;

            foreach ($worksheet->getRowIterator() as $row) {
                $celdaIterator = $row->getCellIterator();
                $celdaIterator->setIterateOnlyExistingCells(false);
                $fila = [];

                foreach ($celdaIterator as $cell) {
                    $fila[] = $cell->getValue();
                }

                if ($firstRow) {
                    $keys = $fila;
                    $firstRow = false;
                } else {
                    $filas[] = array_combine($keys, $fila);
                }
            }

            foreach ($filas as $fila) {
                $new_row = AppointmentMl::updateOrCreate([
                    'Tratamiento_Nr' => $fila['Atencion']
                ],[
                    'Estado' => $fila['Estado'],
                    'Fecha' => $fila['Fecha'] ,
                    'Fecha_Generación' => $fila['Fecha Generación'] ,
                    'Hora_inicio' => $fila['Hora inicio'] ,
                    'Hora_termino' => $fila['Hora termino'] ,
                    'Tratamiento_Nr' => $fila['Atencion'] ,
                    'Profesional' => $fila['Profesional/Recurso'] ,
                    'Rut_Paciente' => $fila['Rut Paciente'] ,
                    'Nombre_paciente' => $fila['Nombre paciente'] ,
                    'Apellidos_paciente' => $fila['Apellidos paciente'] ,
                    'Mail' => $fila['E-mail'] ,
                    'Celular' => $fila['Celular'] ,
                    'Convenio' => $fila['Convenio'] ,
                    'comentario' => $fila['Ultimo comentario'],
                    'Sucursal' => 'You',
                ]);
            }

        } catch (ReaderException $e) {
            // Manejo del error
            return response()->json(['error' => 'Error al leer el archivo: ' . $e->getMessage()], 500);
        }

        return redirect()->back();
    }
}
