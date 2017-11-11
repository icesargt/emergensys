<?php

namespace App\Http\Controllers;

use App\Specialty;
use Validator;
use Alert;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('descripcion'));

        $list_specialitys = Specialty::searchSpeciality($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vspecialitys.index', [
                'list_specialitys' => $list_specialitys,
            ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.vspecialitys.create');
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
            Alert::error('La especialidad que intenta agregar ya existe. Agregue nueva especialidad.', 'Especialidad Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nueva cuota.
            $new_speciality = new Specialty;
            $new_speciality->description = $request->descripcion;
            $new_speciality->save();

            Alert::success('Ha agregado una nueva Especialidad.', 'Nueva Especialidad');
            return redirect()->route('speciality.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $speciality_edit = Specialty::findOrFail($id);

        return view('backend.vspecialitys.edit', [
                'speciality_edit' => $speciality_edit,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialty  $specialty
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
            Alert::error('La especialidad que esta agregando ya existe. No se actualizará dicho registro.', 'Actualizar');
            return redirect()->route('speciality.index');
        }else
            {
                // Actualizar tipo de puesto.
                $edit_speciality = Specialty::findOrFail($id);
                $edit_speciality->description = $request->descripcion;
                $edit_speciality->save();

                Alert::success('Ha actualizado el registro.', 'Actualizar');
                return redirect()->route('speciality.index');             
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialty_delete = Specialty::findOrFail($id);        
        $specialty_delete->delete();
       
        Alert::success('Ha eleiminado la especialidad seleccionada.', 'Eliminar');        
        return redirect()->route('speciality.index');
    }

    private function getVerifyExistsData($descripcion)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Specialty::where('description', $descripcion)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
