<?php

namespace App\Http\Controllers;

use App\Level;
use Validator;
use Alert;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('descripcion'));

        $list_levels = Level::searchLevel($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vlevels.index', [
                'list_levels' => $list_levels,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vlevels.create');
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
            Alert::error('El estado de salud que intenta agregar ya existe.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nueva cuota.
            $new_level = new Level;
            $new_level->description = $request->descripcion;
            $new_level->save();

            Alert::success('Ha agregado un nuevo estado de salud.', 'Nuevo Registro');
            return redirect()->route('level_danger.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $level_edit = Level::findOrFail($id);

        return view('backend.vlevels.edit', [
                'level_edit' => $level_edit,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Level  $level
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
            Alert::error('El estado de salud que intenta agregar ya existe. No se actualizará el registro.', 'Registro Existente');
            return redirect()->route('level_danger.index');
        }else
            {
                // Actualizar tipo de puesto.
                $edit_speciality = Level::findOrFail($id);
                $edit_speciality->description = $request->descripcion;
                $edit_speciality->save();

                Alert::success('Ha actualizado el registro.', 'Actualizar');
                return redirect()->route('level_danger.index');             
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty_delete = Level::findOrFail($id);        
        $specialty_delete->delete();
       
        Alert::success('Ha eliminado el estado de salud elegido.', 'Eliminar');        
        return redirect()->route('level_danger.index');
    }

    private function getVerifyExistsData($descripcion)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Level::where('description', $descripcion)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
