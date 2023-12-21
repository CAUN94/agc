<?php

namespace App\Http\Controllers;

use App\Models\AdminRemuneracion;
use Illuminate\Http\Request;
use App\Models\ActionMl;
use App\Models\Professional;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class adminRemuneracionController extends Controller
{
    public function __construct() {
        $this->middleware('intranet');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.adminRemuneracion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        return view('admin.adminRemuneracion.show',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\adminRemuneracion  $professionaAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(adminRemuneracion $adminRemuneracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\adminRemuneracion  $professionalAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, adminRemuneracion $adminRemuneracion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mesActual  $mesActual
     * @return \Illuminate\Http\Response
     */
    public function destroy(adminRemuneracion $adminRemuneracion)
    {
        //
    }

    public function allAcions(){
        $now = Carbon::Now();
        if (Carbon::now()->format('d') < 21 ){
            $startOfMonth = Carbon::createFromDate($now->format('Y'),$now->format('m')-1,20)->startOfDay();
            $actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,20)->startOfDay();
            $expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')-1,20)->startOfDay()->subMonth();
            $endOfMonth = Carbon::createFromDate($now->format('Y'),$now->format('m'),20)->endOfDay();
            $expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),21)->startOfDay()->subMonth();

            $startOfWeek = Carbon::createFromDate($now->format('Y'),$now->startOfWeek()->format('m'),$now->startOfWeek()->format('d'))->startOfDay();
            $endOfWeek = Carbon::createFromDate($now->format('Y'),$now->endOfWeek()->format('m'),$now->endOfWeek()->format('d'))->startOfDay();
        } else {

            $startOfMonth = Carbon::createFromDate($now->format('Y'),$now->format('m'),20)->startOfDay();
            $actualstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay();
            $expiredstartOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m'),20)->startOfDay()->subMonth();
            $endOfMonth = Carbon::createFromDate($now->format('Y'),$now->format('m')+1,21)->endOfDay();
            $expiredendOfMonth = Carbon::createFromDate(Carbon::Now()->format('Y'),Carbon::Now()->format('m')+1,21)->startOfDay()->subMonth();

            $startOfWeek = Carbon::createFromDate($now->format('Y'),$now->startOfWeek()->format('m'),$now->startOfWeek()->format('d'))->startOfDay();
            $endOfWeek = Carbon::createFromDate($now->format('Y'),$now->endOfWeek()->format('m'),$now->endOfWeek()->format('d'))->startOfDay();
        }
        $now = Carbon::Now()->subMonth();

        $newAppointment = 0;
        $coach = 0;

        $appointments = ActionMl::where('Estado','Atendido')
                                ->where('Fecha_Realizacion','>',$expiredstartOfMonth->format('Y-m-d'))
                                ->where('Fecha_Realizacion','<',$expiredendOfMonth->format('Y-m-d'))
                                ->groupBy('Tratamiento_Nr')
                                ->select('*','Tratamiento_Nr', DB::raw('SUM(Precio_Prestacion) as TP'), DB::raw('SUM(Abono) as TA'))
                                ->orderby('Fecha_Realizacion', 'DESC')->get();

        $coff = Professional::all();

        return view('admin.adminRemuneracion.all',compact('appointments','coff'));
    }
}
