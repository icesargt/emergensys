<?php

namespace App\Http\Controllers;

use App\Salary;
use Validator;
use Alert;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Muestra listado de salarios registrados.
     * Permite hacer uso de busqueda.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salary_search = trim($request->get('salario'));

        $salary_list = Salary::salarios($salary_search)->where('status',1)
        ->orderBy('year')
        ->paginate(10);

        return view('backend.salary.index', [
                'salary_list' => $salary_list,
            ]);
    }

    /**
     * Muestra una vista para crear un salario.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.salary.create');
    }

    /**
     * Valida datos y crea un nuevo regisgro de Salario Ordinario.
     * Campos: year, ordinary_salary
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'periodo' => 'required|digits_between:4,4|numeric',
            'salario' => 'required|numeric|between:2500.00,100000.00',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un salario con el mismo año.
         */
        $result = $this->getVerifyExistsDataSalaries($request->periodo);

        if ($result) {
            Alert::error('Ya existe un salario para el año elegido. Solo puede regisrar un Salario Anual.', 'Salario Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nuevo salario.
            $new_salary = new Salary;
            $new_salary->year = $request->periodo;
            $new_salary->ordinary_salary = $request->salario;
            $new_salary->save();

            Alert::success('Ha agregado un nuevo Salario.','Nuevo Salario');            
            return redirect()->route('salarios.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $id_salary
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra la vista edit, recibiendo un parametro: id_salary.
     * Busca la informacion y redirecciona a la vista.
     *
     * @param  \App\Salary  $id_salary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salary_edit = Salary::findOrFail($id);

        return view('backend.salary.edit', [
                'salary_edit' => $salary_edit,
            ]);
    }

    /**
     * Actualiza los datos existentes, por los recibidos en request.
     * Campos recibidos: periodo, salario.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $id_salary
     * @param  \App\Salary  $periodo = year
     * @param  \App\Salary  $salario = ordinary_salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'periodo' => 'required|digits_between:4,4|numeric',
            'salario' => 'required|numeric|between:2500.00,100000.00',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $result = $this->getVerifyExistsDataSalaries($request->periodo);

        if ($result) {
            // Actualziar solo el salario.
            $edit_salary = Salary::findOrFail($id);
            //$edit_salary->year = $request->periodo;
            $edit_salary->ordinary_salary = $request->salario;
            $edit_salary->save();

            Alert::success('Se ha actualizado solo el Salario','Salario Anual');
            return redirect()->route('salarios.index');
        }else{
            // Actualizar datos de Salario y año.
            $edit_salary = Salary::findOrFail($id);
            $edit_salary->year = $request->periodo;
            $edit_salary->ordinary_salary = $request->salario;
            $edit_salary->save();

            Alert::success('Salario Ordinario actualizada.','Actualizar Salario');
            return redirect()->route('salarios.index');
        }
    }

    /**
     * Eliminar un salario, de forma logica.
     *
     * @param  \App\Salary  $id_salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary_delete = Salary::findOrFail($id);

        $salary_delete->status = 0;
        $salary_delete->save();

        Alert::success('Salario dado de baja.','Eliminar Salario');
        return redirect()->route('salarios.index');
    }


    /**
     * [getVerifyExistsDataSalaries description]
     * 
     * Al momento de crear:
     * verifyExistsData: verifica si existe un registro de Igss con el mismo año.
     * Si existe, no dejerá crear otro con el mismo año.
     *
     * Sino existe el registro, se procede a crear una nueva cuota.
     *
     * Al momento de actualizar.
     * Si existe un registro, solo actualizará la cuota, manteniendo el año.
     *
     * Sino existe el registro, se procede a actualizar el año y la cuota.
     * 
     * @param  @year
     * @return boolean       true|false
     */
    
    private function getVerifyExistsDataSalaries($year)
    {
        $result_value = false;

        // Buscar coincidencia
        $salary = Salary::where('year', $year)
                        ->where('status', 1)
                        ->first();

        if ($salary) 
            return $result_value = true;
        else
            return $result_value;
    }
}
