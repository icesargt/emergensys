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
use DB;

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

        // Si contienen datos.
        if ( ($request->get('year') != null) && ($request->get('mes') != null) ) 
        {
            
            $paystatus = true;
            // Recibir valores desde formulario.
            $search_year = intval($request->get('year'));
            $search_month = intval($request->get('mes'));


            // Validar si existe una cuota para el año, elegido.
            $yearIgss = $this->getIgss($search_year);

            if (!$yearIgss) {
                Alert::error('No existe cuota Igss del año elegido. Por favor, agrege una nueva cuota.', 'Cuota Igss');
                //$paystatus = false;
                return redirect()->back()->withInput();               
            }

            // Validar si existe un salario ordinario para el año, elegido.
            $yearSalary = $this->getSalary($search_year);

            if (!$yearSalary) {
                Alert::error('No existe Salario Ordinario asignado al año elegido. Por favor, agrege una Salario Ordinario.', 'Salario Ordinario');
                return redirect()->back()->withInput();
            }

            // Validar si ya se genero una planilla, en el año y mes elegidos.
            $payroll_details = $this->getPayrollExists($search_year, $search_month);

            if ($payroll_details) {
                 Alert::info('Ya se ha creado una planilla para el año y mes elegidos. Se mostrarán los datos.', 'Planilla Existente');
                //return redirect()->back()->withInput();
            }else{
                echo "generar nueva planilla para guardar.";
            }

            

            

            

            


            // $list_ids = DB::table('employees')
            //             ->select('id_employee')
            //             ->get();
            
            

            $employees_list = Employee::paginate(50);

            

            

            return view('backend.payroll.index', [
                    'months' => $months,
                    // 'exist_payroll' => $exist_payroll,
                    'employees_list' => $employees_list,
                    'yearIgss' => $yearIgss,
                    'yearSalary' => $yearSalary,
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
    // private function getExistsPayroll($year, $month)
    // {
    //     $result_value = false;

    //     $payroll_verify = Payroll::whereYear('year', $year)
    //                             ->whereMonth('month', $month)
    //                             ->where('status', 1)
    //                             ->first();
    //     if ($payroll_verify)
    //         return $result_value = true;
    //     else
    //         return $result_value;
    // }

    // // Buscar empleados con mes y año igual al buscado.
    // private function searchRecordsEquals($year, $month, $id)
    // {
    // 	$employee = Employee::with('employeerecord')
    // 					->whereYear('created_date', $year)
    // 					->whereMonth('created_date', $month)
    // 					->where('employee_id', $id)
    // 					->get();

    // }
    
    /**
     * getIgss Validar si existe una cuota para el año elegido.
     * @param   $year 
     * @return  $igss_search | objeto
     */
    
    private function getIgss($year)
    {        
        $igss_search = Igss::select('id_igss', 'quota')
                    ->where('status', 1)
                    ->where('year', $year)
                    ->first();
    
        if ($igss_search) {
            return $igss_search;
        }else{
            return $igss_search = false;
        }
    }

    /**
     * getSalary Validar si existe salario ordinario asigando para el año elegido.
     * @param   $year 
     * @return  $salary_search | objeto
     */
    
    private function getSalary($year)
    {        
        $salary_search = Salary::select('id_salary', 'ordinary_salary')
                    ->where('status', 1)
                    ->where('year', $year)
                    ->first();
    
        if ($salary_search) {
            return $salary_search;
        }else{
            return $salary_search = false;
        }
    }

    // Validar si existe una planilla previamente.
    private function getPayrollExists($year, $month)
    {
        $payroll_data = Payroll::select('id_payroll', 'year', 'month', 'generated_date')
                                ->where('status', 1)
                                ->where('year', $year)
                                ->where('month', $month)
                                ->first();

        if ($payroll_data) {
            return $payroll_data;
        }else{
            return $payroll_data = false;
        }

    }
}   
