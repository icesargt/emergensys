<?php

namespace App\Http\Controllers;

use App\TypeJob;
use Validator;
use Alert;
use Illuminate\Http\Request;

class TypeJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('descripcion'));

        $type_jobs = TypeJob::searchTypes($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vtypejobs.index', [
                'type_jobs' => $type_jobs,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vtypejobs.create');
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
            Alert::error('El puesto que intenta agregar ya existe. Elija un puesto diferente.', 'Puesto Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nueva cuota.
            $new_type = new TypeJob;
            $new_type->description = $request->descripcion;
            $new_type->save();

            Alert::success('Ha agregado un nuevo puesto.', 'Nuevo Puesto');
            return redirect()->route('categories.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypeJob  $typeJob
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypeJob  $typeJob
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type_edit = TypeJob::findOrFail($id);

        return view('backend.vtypejobs.edit', [
                'type_edit' => $type_edit,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypeJob  $typeJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'descripcion' => 'required|max:100',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        // Consultar si existe un registro que coincide con el año.
        $result = $this->getVerifyExistsData($request->descripcion);
        
        if ($result)
        {            
            Alert::error('El puesto ingresado ya existe. No se actualizará dicho registro.', 'Actualizar');
            return redirect()->route('categories.index');
        }else
            {
                // Actualizar tipo de puesto.
                $edit_type = TypeJob::findOrFail($id);
                $edit_type->description = $request->descripcion;
                $edit_type->save();

                Alert::success('Ha actualizado el tipo de puesto.', 'Actualizar');
                return redirect()->route('categories.index');             
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypeJob  $typeJob
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type_delete = TypeJob::findOrFail($id);        
        $type_delete->delete();
       
        Alert::success('Ha eliminado el puesto elegido.', 'Eliminar');        
        return redirect()->route('categories.index');
    }

    private function getVerifyExistsData($descripcion)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = TypeJob::where('description', $descripcion)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }


}
