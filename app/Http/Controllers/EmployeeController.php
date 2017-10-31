<?php

namespace App\Http\Controllers;

use App\Employee;
use Validator;
use Alert;
use DB;
use DateTime;
use App\Record;
use Carbon\Carbon;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Busca un empleado, si encuentra coincidencias: lista los datos.
     * Sino, se apoya en scopeEmpleados para mostrar el listado completo.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee_search = trim($request->get('nombre'));

        $employee_list = Employee::empleados($employee_search)->where('status','<>',2)
        ->orderBy('start_date')
        ->paginate(10);

        return view('backend.employee.index', [
                'employee_list' => $employee_list,
            ]);
    }

    /**
     * Muestra una vista para agregar un empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.employee.create');
    }

    /**
     * Valida los datos y crea un nuevo registro en Employees
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Reglas de validación de datos, y validación con Validator.
         */
        
        $v = Validator::make($request->all(), [
                'nombre' => 'required|max:50',
                'apellido' => 'required|max:50',
                'fecha' => 'required|date_format:d/m/Y',
                'bonificacion' => 'required|numeric|between:250.00,10000.00',
                'isr' => 'required|numeric|between:10.00,10000.00',
        ]);

        if ($v->fails()) 
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        // Convertir fecha de formato dd/mm/yyyy a Y-m-d de MysQL
        $initial_date = DateTime::createFromFormat('d/m/Y', $request->fecha);
        $insert_date_start = $initial_date->format('Y-m-d');
        
        // Crear instancia de modelo Employee
        $new_employee = new Employee;
        $new_employee->name = $request->get('nombre');
        $new_employee->last_name = $request->get('apellido');
        $new_employee->start_date = $insert_date_start;
        $new_employee->bonus = $request->get('bonificacion');
        $new_employee->isr = $request->get('isr'); 
        $new_employee->created_date = $insert_date_start;

        $new_employee->save();

        /**
         * Creación del registro de historial
         * @param  $id_employee, id de empleado.
         * @param  $bonus, bono asignado.
         * @param  $isr, isr asignado.
         * 
         */
        
        // $dt = Carbon::now();
        // $date_save = $dt->toDateString();

        $new_record = new Record;        
        $new_record->employee_id = $new_employee->id_employee;
        $new_record->bonus_rec = $request->get('bonificacion');        
        $new_record->isr_rec = $request->get('isr');
        $new_record->created_record = $insert_date_start;
        $new_record->save();

        Alert::success('Ha agregado un nuevo Empleado.','Empleado Nuevo'); 
        return redirect()->route('empleados.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Muestra la vista edit, para editar los datos de un empleado.
     *
     * @param  \App\Employee  $id_employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_edit = Employee::findOrFail($id);

        $records = Record::where('employee_id', $id)
            ->paginate(10);

        return view('backend.employee.edit', [
            'employee_edit' => $employee_edit,
            'records' => $records,
        ]);
    }

    /**
     * Actualiza los datos de empleados, excepto los campos: bonus, isr.
     * Para bonus e isr, existe otra función.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $id_employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validación de datos, y validación con Validator.
         */        
        $v = Validator::make($request->all(), [
                'nombre' => 'required|max:50',
                'apellido' => 'required|max:50',
                // Fecha de inicio de labores
                'fecha_inicio' => 'required|date_format:d/m/Y',
                // estado, para validar si esta activo o inactivo.
                'estado' => 'required|max:1', 
                // Fecha de inactividad.
                'fecha_inactivo' => 'nullable|date_format:d/m/Y',
                // 'bonificacion' => 'required|numeric|between:250.00,10000.00',
                // 'isr' => 'required|numeric|between:10.00,10000.00',
        ]);

        if ($v->fails()) 
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        // Convertir fecha de formato dd/mm/yyyy a Y-m-d de MysQL
        $initial_date = DateTime::createFromFormat('d/m/Y', $request->fecha_inicio);
        $insert_date_start = $initial_date->format('Y-m-d');

        if ($request->fecha_inactivo != null) {
            $inactive_date = DateTime::createFromFormat('d/m/Y', $request->fecha_inactivo);
            $insert_inactivity_date = $inactive_date->format('Y-m-d');
        }else{
            $insert_inactivity_date = "";
        }
        
        // Busca los datos del Employee
        $employee_edit = Employee::findOrFail($id);

        $employee_edit->name = $request->get('nombre');
        $employee_edit->last_name = $request->get('apellido');
        $employee_edit->start_date = $insert_date_start;
        $employee_edit->status = $request->get('estado');
        $employee_edit->inactivity_date = $insert_inactivity_date;
        
        $employee_edit->save();

        Alert::success('Ha actualizado los datos personales del Empleado.','Actualización');
        return redirect()->route('empleados.index');
    }

    /**
     * Eliminar un registro de Empleado.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee_delete = Employee::findOrFail($id);

        $employee_delete->status = 2; // status = 2 -> deleted
        $employee_delete->save();

        Alert::success('Registro de Empleado eliminado.','Eliminar');
        return redirect()->route('empleados.index');
    }

    /**
     * Funcion: setHistorial
     * @param   $id_empoyee, para asociar el empleado al historial
     * @param   $bonificacion: bonificacion actualizada
     * @param   $isr: retencion de isr actualizada
     *
     * Crea un nuevo registro de historial de bono, cada vez que se
     * agregue un nuevo empleado o se actualice los datos del empleado
     * en la sección de salarios.
     */    
    public function setNewRecord(Request $request, $id)
    {
        /**
         * Reglas de validación de datos, y validación con Validator.
         */        
        $v = Validator::make($request->all(), [            
            'bonificacion' => 'required|numeric|between:250.00,10000.00',
            'isr' => 'required|numeric|between:10.00,10000.00',
            'fecha_actualizacion' => 'nullable|date_format:d/m/Y',
        ]);

        if ($v->fails()) 
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $date_update = DateTime::createFromFormat('d/m/Y', $request->fecha_actualizacion);
        $save_update_date = $date_update->format('Y-m-d');

        /**
         * Actualizar datos de empleado, usando modelo Employee.
         * @param   $id, id del empleado a buscar
         * @param   $bonificacion, nueva bonificación asigndada.
         * @param   $isr, nuevo isr asignado.
         */

        // Guardar cambios en Empleados
        $edit_bonus = Employee::findOrFail($id);        
        $edit_bonus->bonus = $request->get('bonificacion');
        $edit_bonus->isr = $request->get('isr'); 
        $edit_bonus->created_date = $save_update_date;
        $edit_bonus->save();
        
        // Guardar cambios en Historial
        $new_record = new Record;        
        $new_record->employee_id = intval($id);
        $new_record->bonus_rec = $request->get('bonificacion');        
        $new_record->isr_rec = $request->get('isr');
        $new_record->created_record = $save_update_date;

        $new_record->save();

        Alert::success('Ha actualizado Bono e ISR.', 'Sección Salarios');
        return redirect()->back();
        // route('empleados.index')->with('success', 'Empleado dado de baja.');  
    }



    private function setUpdateRecord($id_get_record, $id_emp, $new_bonus, $new_isr)
    {
        // Nueva instancia de Carbon, para transformar
        // la fecha con la que se guarda los cambios.
        $dt = Carbon::now();
        $date_save = $dt->toDateString();

        $edit_record = Record::findOrFail($id_get_record);
        $edit_record->employee_id = $id_emp;
        $edit_record->bonus_rec = $new_bonus;        
        $edit_record->isr_rec = $new_isr;        

        $edit_record->save();
    }

} // fin de clase
