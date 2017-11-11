<?php

namespace App\Http\Controllers;

use App\Prescription;
use App\Disease;
use Validator;
use Alert;

use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('prescripcion'));

        $list_prescriptions = Prescription::searchPrescription($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vprescriptions.index', [
                'list_prescriptions' => $list_prescriptions,
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
        $list_disease = Disease::select('id_disease', 'description')->get();

        return view('backend.vprescriptions.create', [
                'list_disease' => $list_disease,
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
            'enfermedad' => 'required',
            'receta' => 'required|max:100',
            'observaciones' => 'required|max:100',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        $result = $this->getVerifyExistsData($request->receta);

        if ($result) {
            Alert::error('Actualemten ya existe este registro.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{
        
            // Agregar nueva prescription.
            $new_prescription = new Prescription;
            $new_prescription->disease_id = $request->enfermedad;
            $new_prescription->recet = $request->receta;
            $new_prescription->observations = $request->observaciones;

            $new_prescription->save();

            Alert::success('Ha agregado una nueva Prescripción Médica.', 'Nueva Prescripción');
            return redirect()->route('medical_prescription.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list_disease = Disease::select('id_disease', 'description')->get();

        $prescription_edit = Prescription::findOrFail($id);

        return view('backend.vprescriptions.edit', [
                'prescription_edit' => $prescription_edit,
                'list_disease' => $list_disease,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'enfermedad' => 'required',
            'receta' => 'required|max:100',
            'observaciones' => 'required|max:100',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        // $result = $this->getVerifyExistsData($request->receta);

        // if ($result) {
        //     Alert::error('Actualemten ya existe este registro.', 'Registro Existente');
        //     return redirect()->back()->withInput();
        // }else{
        
            // Agregar nueva prescription.
            $new_disease = Prescription::findOrFail($id);
            $new_disease->disease_id = $request->enfermedad;
            $new_disease->recet = $request->receta;
            $new_disease->observations = $request->observaciones;

            $new_disease->save();

            Alert::success('Ha actualizado la Prescripción Médica.', 'Actualizar');
            return redirect()->route('medical_prescription.index'); 
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prescription_delete = Prescription::findOrFail($id);
        $prescription_delete->delete();
       
        Alert::success('Ha eliminado el registro elegido.', 'Eliminar');        
        return redirect()->route('medical_prescription.index');
    }


    private function getVerifyExistsData($receta)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Prescription::where('recet', $receta)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
