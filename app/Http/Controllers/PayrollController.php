<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Payroll;
use App\PayrollDetail;
use App\Employee;
use App\Igss;
use App\Record;
use App\Salary;
use App\User;
use Validator;
use Alert;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            $months = array(
                '1' => 'Enero',
                '2' => 'Febrero',
                '3' => 'Marzo',
                '4' => 'Abril',
                '5' => 'Mayo',
                '6' => 'Junio',
                '7' => 'Julio',
                '8' => 'Agosto',
                '9' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre',
            );
        
        if (($request->get('mes') == null) && ($request->get('year') == null) ) 
        {
            $paystatus = false;
            
            return view('backend.payroll.index',[
                    'months' => $months,                    
                    'paystatus' => $paystatus
                ]);
        }

        if ($request) {
            $paystatus = true;
            // Recibir valores desde formulario.
            $search_month = $request->get('mes');
            $search_year = $request->get('year');
        
            /**
             * Verificar si existe un registro de planilla para el mes y año buscado.
             */
            $exist_payroll = Payroll::where('year', $search_year)
                                        ->where('month', $search_month)
                                        ->paginate(50);

            //dd($exist_payroll);

            // if ($exist_payroll->total() > 0) {
            //     return $exist_payroll;
            // }

            /**
             * Cargar datos de empleados, con estatus activo hasta el mes solicitado.
             */
            $employees_list = Employee::where('status','<>',2)
                                        ->paginate(50);

            

            /**
             * Cargar cuota de Igss actual.
             */
            $igss_list = Igss::where('year',$search_year)
                            ->where('status',1)
                            ->first();

                    //dd($igss_list);
            /**
             * Cargar salario anual al año solicitado.
             */
            $salarys_list = Salary::where('year', $search_year)
                                ->where('status',1)
                                ->first();

            return view('backend.payroll.index', [
                    'months' => $months,
                    'exist_payroll' => $exist_payroll,
                    'employees_list' => $employees_list,
                    'igss_list' => $igss_list,
                    'salarys_list' => $salarys_list,
                    'paystatus' => $paystatus
                ]);
        }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }

    /**
     * Consultar planilla, según año y mes elegido.
     */
    
    public function getPayrollDetailsExist()
    {

    }
}
