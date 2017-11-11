<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Level;
use Validator;
use Alert;
use DateTime;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('descripcion'));

        $list_diseases = Disease::searchDisease($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vdiseases.index', [
                'list_diseases' => $list_diseases,
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
        $list_level = Level::select('id_level', 'description')->get();

        return view('backend.vdiseases.create', [
                'list_level' => $list_level,
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
            'causa' => 'required|max:100',
            'primer_sintoma' => 'required|max:100',
            'segundo_sintoma' => 'required|max:100',
            'tercer_sintoma' => 'required|max:100',            
            'fecha' => 'required|date_format:d/m/Y',
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
            Alert::error('Actualemten ya existe este registro.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{

            // Convertir fecha de formato dd/mm/yyyy a Y-m-d de MysQL
            $initial_date = DateTime::createFromFormat('d/m/Y', $request->fecha);
            $save_date = $initial_date->format('Y-m-d');

            // Agregar nueva cuota.
            $new_disease = new Disease;
            $new_disease->level_id = $request->tipo;
            $new_disease->description = $request->descripcion;
            $new_disease->cause = $request->causa;
            $new_disease->first_sintom = $request->primer_sintoma;
            $new_disease->second_sintom = $request->segundo_sintoma;
            $new_disease->third_sintom = $request->tercer_sintoma;
            $new_disease->day_detected = $save_date;

            $new_disease->save();

            Alert::success('Ha agregado un nuevo diagnóstico.', 'Nuevo Registro');
            return redirect()->route('pathologic_lists.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_level = Level::select('id_level', 'description')->get();

        $disease_edit = Disease::findOrFail($id);

        return view('backend.vdiseases.edit', [
                'disease_edit' => $disease_edit,
                'list_level' => $list_level,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disease  $disease
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
            'causa' => 'required|max:100',
            'primer_sintoma' => 'required|max:100',
            'segundo_sintoma' => 'required|max:100',
            'tercer_sintoma' => 'required|max:100',            
            'fecha' => 'required|date_format:d/m/Y',
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
            Alert::error('Actualemten ya existe este registro. No se actualizará.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{

            // Convertir fecha de formato dd/mm/yyyy a Y-m-d de MysQL
            $initial_date = DateTime::createFromFormat('d/m/Y', $request->fecha);
            $save_date = $initial_date->format('Y-m-d');

            // Agregar nueva cuota.
            $edit_disease = Disease::findOrFail($id);;
            $edit_disease->level_id = $request->tipo;
            $edit_disease->description = $request->descripcion;
            $edit_disease->cause = $request->causa;
            $edit_disease->first_sintom = $request->primer_sintoma;
            $edit_disease->second_sintom = $request->segundo_sintoma;
            $edit_disease->third_sintom = $request->tercer_sintoma;
            $edit_disease->day_detected = $save_date;

            $edit_disease->save();

            Alert::success('Registro actualizado correctamente.', 'Actualizar');
            return redirect()->route('pathologic_lists.index'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disease_delete = Disease::findOrFail($id);        
        $disease_delete->delete();
       
        Alert::success('Ha eliminado el registro elegido.', 'Eliminar');        
        return redirect()->route('pathologic_lists.index');
    }

    private function getVerifyExistsData($descripcion)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Disease::where('description', $descripcion)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
