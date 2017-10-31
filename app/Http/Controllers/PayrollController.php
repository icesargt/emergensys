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
        
        // Verificar si se genera una petición de busqueda.        
        if ( ($request->get('year') == null) && ($request->get('mes') == null) ) 
        {
            $paystatus = false;            
            return view('backend.payroll.index',[
                    'months' => $months,                    
                    'paystatus' => $paystatus
                ]);            
        }

        // Si las variables contienen datos.
        if ( ($request->get('year') != null) && ($request->get('mes') != null) ) 
        {
            
            $paystatus = true;
            // Recibir valores desde formulario.
            $search_year = intval($request->get('year'));
            $search_month = intval($request->get('mes'));


            $list_ids = Employee::select('id_employee')
            					->where('status', 1)            					
            					->get();

           	





         //    $employee = Employee::with('employeerecord')
    					// ->whereYear('created_date', $search_year)
    					// ->whereMonth('created_date', $search_month)
    					// ->where('employee_id', $list_ids) whereIn('employee_id', $list_ids)
    					// ->get();
    		
    		$emp = Employee::where('status', 1)
    						->with(['employeerecord' => function($query) use ($search_year, $search_month){
    							$query->whereYear('created_record', '>=', $search_year)
    								->whereMonth('created_record', '>=', $search_month)
    								->orderBy('created_record', 'desc')
    								->first();
    							}])
    						->get();

    		dd($emp);





    		$employee = Employee::with('employeerecord')
    					->whereYear('created_date', $search_year)
    					->whereMonth('created_date', $search_month)
    					->where('employee_id', $list_ids)
    					->get();


    		dd($employee);



            $data_employee = Employee::with('recordsemp')->get();//with('records'); //->where('status','<>',2);
            foreach ($data_employee as $key => $value) {
                dd(
                    $value->name,
                    $value->bonus


                    );
            }

            // Verificar si existe planilla. Si existe, mostrar la planilla y detalles de la misma.
            $verifyPayroll = $this->getExistsPayroll($search_year, $search_month);

            if ($verifyPayroll) {
                $data_payrolls = Payroll::PayrollExists($search_year, $search_month)->first();
                $data_salries = Salary::salariesPayroll($search_year)->first();
                $data_igss = Igss::gssPayroll($search_year)->first();
                $data_employee = Employee::with('records')->where('status','<>',2);


                $data_details = PayrollDetail::where('payroll_id', $data_payrolls->id_payroll)
                                             ->where('employee_id',l);

            }
            //dd($verifyPayroll);
            


            //$existPayroll = Payroll::planillaExistente($search_year, $search_month)->first();

            //dd($existPayroll);

        
        
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
    } // fin index

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

    
    /**
     * getExistsPayroll: Verifica si existe un registro previo de Planilla.
     * @param   $year  
     * @param   $month 
     * @return boolean  true|false
     */
    private function getExistsPayroll($year, $month)
    {
        $result_value = false;

        $payroll_verify = Payroll::whereYear('year', $year)
                                ->whereMonth('month', $month)
                                ->where('status', 1)
                                ->first();
        if ($payroll_verify)
            return $result_value = true;
        else
            return $result_value;
    }

    // Buscar empleados con mes y año igual al buscado.
    private function searchRecordsEquals($year, $month, $id)
    {
    	$employee = Employee::with('employeerecord')
    					->whereYear('created_date', $year)
    					->whereMonth('created_date', $month)
    					->where('employee_id', $id)
    					->get();

    }
}
