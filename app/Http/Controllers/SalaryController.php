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
     * Campos: year, ordinay_salary
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

        // Nueva instancia del modelo Salary, para agregaar un nuevo registro, 
        // con los datos validados.
        $new_salary = new Salary;
        $new_salary->year = $request->periodo;
        $new_salary->ordinary_salary = $request->salario;

        $new_salary->save();

        // Muestra una alerta que se cierra a los 1.5 seg.
        alert()->success('Ha agregado un nuevo salario satisfactoriamente.', 'Crear Salario')->autoclose(1500);
        return redirect()->route('salarios.index');
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

        // Consulta modelo.
        $edit_salary = Salary::findOrFail($id);

        $edit_salary->year = $request->periodo;
        $edit_salary->ordinary_salary = $request->salario;
        $edit_salary->save();

        return redirect()->route('salarios.index')->with('success', 'Salario Ordinario actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $id_salary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salary_delete = Salary::findOrFail($id);

        $salary_delete->status = 0;
        $salary_delete->save();

        alert()->success('Salario dado de baja.','Eliminar','success');

        return redirect()->route('salarios.index');
    }
}
