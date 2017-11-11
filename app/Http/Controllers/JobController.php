<?php

namespace App\Http\Controllers;

use App\Job;
use App\TypeJob;
use Validator;
use Alert;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('descripcion'));

        $list_jobs = Job::searchJob($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vjobs.index', [
                'list_jobs' => $list_jobs,
                //'list_types' => $list_types,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_types = TypeJob::select('id_type', 'description')->get();

        return view('backend.vjobs.create', [ 
                'list_types' => $list_types,
            ]);
    }

    /**
     * Store a newly created resource in storage.
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
            'tipo' => 'required',
            'descripcion' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        $result = $this->getVerifyExistsData($request->descripcion);

        if ($result) {
            Alert::error('El puesto que intenta agregar ya existe.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nueva cuota.
            $new_job = new Job;
            $new_job->type_id = $request->tipo;
            $new_job->description = $request->descripcion;
            $new_job->save();

            Alert::success('Ha agregado un nuevo puesto de trabajo.', 'Nuevo Registro');
            return redirect()->route('positions.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_types = TypeJob::select('id_type', 'description')->get();

        $job_edit = Job::findOrFail($id);

        return view('backend.vjobs.edit', [
                'job_edit' => $job_edit,
                'list_types' => $list_types,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'tipo' => 'required',
            'descripcion' => 'required|max:100',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        // Consultar si existe un registro que coincide con el año.
        $result = $this->getVerifyExistsData($request->descripcion);
        
        if ($result)
        {            
            Alert::error('El puesto de trabajo ya existe. No se actualizará el registro.', 'Registro Existente');
            return redirect()->route('positions.index');
        }else
            {
                // Actualizar tipo de puesto.
                $edit_job = Job::findOrFail($id);
                $edit_job->type_id = $request->tipo;
                $edit_job->description = $request->descripcion;
                $edit_job->save();

                Alert::success('Ha actualizado el registro.', 'Actualizar');
                return redirect()->route('positions.index');             
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job_delete = Job::findOrFail($id);        
        $job_delete->delete();
       
        Alert::success('Ha eliminado el puesto de trabajo elegido.', 'Eliminar');        
        return redirect()->route('positions.index');
    }

    private function getVerifyExistsData($descripcion)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Job::where('description', $descripcion)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
