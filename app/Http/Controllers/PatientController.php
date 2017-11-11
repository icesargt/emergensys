<?php

namespace App\Http\Controllers;

use App\Patient;
use App\SendAlert;
use Nexmo;
use Auth;
use Validator;
use Alert;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function index(Request $request)
    {
        $search_text = trim($request->get('busqueda'));

        $list_patients = Patient::searchPatients($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

        return view('backend.vpatients.index', [
                'list_patients' => $list_patients,
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
        $list_gen = array(
        'M' => 'M',
        'F' => 'F',
        );
        
        return view('backend.vpatients.create', [
                // 'patient_edit' => $patient_edit,
                'list_gen' => $list_gen,                
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
            'dpi' => 'required|max:16',
            'primer_nombre' => 'required|max:50',
            'segundo_nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'genero' => 'required|max:1',
            'telefono' => 'required|max:12',
            'email' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        $result = $this->getVerifyExistsData($request->email);

        if ($result) {
            Alert::error('Actualemten ya existe un usuario con la misma cuenta de email.', 'Registro Existente');
            return redirect()->back()->withInput();
        }else{
        
            // Agregar nuevo Paciente
            $new_patient = new Patient;
            $new_patient->dpi = $request->dpi;
            $new_patient->first_name = $request->primer_nombre;
            $new_patient->second_name = $request->segundo_nombre;
            $new_patient->last_name = $request->apellido;
            $new_patient->sex = $request->genero;
            $new_patient->mobile_number = $request->telefono;
            $new_patient->email = $request->email;
    
            $new_patient->save();

            Alert::success('El paciente ha sido dado de alta.', 'Paciente Agregado');
            return redirect()->route('patient_lists.index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient_show = Patient::findOrFail($id);

        return view('backend.vpatients.send_message', [
                'patient_show' => $patient_show,                
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $list_gen = array(
        'M' => 'M',
        'F' => 'F',
        );

        $patient_edit = Patient::findOrFail($id);

        return view('backend.vpatients.edit', [
                'patient_edit' => $patient_edit,
                'list_gen' => $list_gen,
                //'list_disease' => $list_disease,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'dpi' => 'required|max:16',
            'primer_nombre' => 'required|max:50',
            'segundo_nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'genero' => 'required|max:1',
            'telefono' => 'required|max:12',
            'email' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        // $result = $this->getVerifyExistsData($request->email);

        // if ($result) {
        //     Alert::error('Actualemten ya existe este registro.', 'Registro Existente');
        //     return redirect()->back()->withInput();
        // }else{
        
            // Agregar nuevo Paciente
            $patient_edit = Patient::findOrFail($id);
            $patient_edit->dpi = $request->dpi;
            $patient_edit->first_name = $request->primer_nombre;
            $patient_edit->second_name = $request->segundo_nombre;
            $patient_edit->last_name = $request->apellido;
            $patient_edit->sex = $request->genero;
            $patient_edit->mobile_number = $request->telefono;
            $patient_edit->email = $request->email;
    
            $patient_edit->save();

            Alert::success('Los datos fueron actualizado.', 'Actualización');
            return redirect()->route('patient_lists.index'); 
        //}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient_delete = Patient::findOrFail($id);
        $patient_delete->delete();
       
        Alert::success('Ha eliminado el registro elegido.', 'Eliminar');        
        return redirect()->route('patient_lists.index');
    }

    private function getVerifyExistsData($email)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $exist = Patient::where('email', $email)                    
                    ->first();
        if ($exist)        
            return $result_value = true;    
        else        
            return $result_value; 
    }

    public function sendMessage(Request $request)
    {
        $validator = Validator::make( $request->all(), [
            'id_patient' => 'required',            
            'telefono' => 'required|max:12',
            'mensaje' => 'required|max:140',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $id = intval( $request->id_patient);
        $number = $request->telefono;
        $notify = $request->mensaje;


        $new_sms = new SendAlert;
        $new_sms->patient_id = intval( $request->id_patient);
        $new_sms->phone_number = $request->telefono;
        $new_sms->message = $request->mensaje;
        $new_sms->user_id = Auth::id();
        
        $exito = $this->notifyEmergency($id, $number, $notify);

        if ($exito) {
            $new_sms->save();
            Alert::success('El mensaje se ha enviado exitosamente.', 'Notificación Enviada');        
            return redirect()->route('patient_lists.index');
        }else{
            Alert::error('Ha ocurrido un error al enviar el mensaje.', 'Verificar Datos');        
            //return redirect()->route('patient_lists.index');
            return redirect()->back()->withInput();
        }

        //dd($request->all());
    }

    private function notifyEmergency($id, $number, $notify)
    {
        $result = false;
        $flag_notify = false;

        $numero = '502'.$number;

        if (isset($numero) && isset($notify)) {

            Nexmo::message()->send([
            'to'   => $numero,
            'from' => 'IArtificial',
            'text' => $notify,
            ]);

            $flag_notify = true;
        }
    
        if ($flag_notify) {
             $result = true;
        }else{
            $result = false;
        }

        return $result;
    }
}
