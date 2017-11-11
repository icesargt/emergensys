<?php

namespace App\Http\Controllers;

use App\SendAlert;
use App\Patient;
use Nexmo;
use Auth;
use Validator;
use Alert;

use Illuminate\Http\Request;

class SendAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_text = trim($request->get('busqueda'));
    
        $list_alerts = \DB::table('send_alerts as a')
                            ->join('patients as p', 'p.id_patient', '=', 'a.patient_id')
                            ->join('users as u', 'u.id', '=', 'a.user_id')
                            ->select(
                                    'id_alert', 'id_patient', 'phone_number', 'first_name', 'last_name', 'message', 
                                    'a.created_at', 'name'
                                )
        //SendAlert::searchAlerts($search_text)
                            ->orderBy('created_at')
                            ->paginate(10);

                            //dd($list_alerts);

        return view('backend.valerts.index', [
                'list_alerts' => $list_alerts,
                //'list_types' => $list_types,
            ]);
    }

    public function getPatients(Request $request)
    {
        $list_patients = Patient::paginate(10);
        return view('backend.valerts.list', [
                'list_patients' => $list_patients,
                //'list_types' => $list_types,
            ]);
    }






    // Enviar nuevo mensaje

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SendAlert  $sendAlert
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient_show = Patient::findOrFail($id);

        return view('backend.valerts.show_message', [
                'patient_show' => $patient_show,                
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SendAlert  $sendAlert
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient_show = Patient::findOrFail($id);

        return view('backend.valerts.send_message_twilio', [
                'patient_show' => $patient_show,                
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SendAlert  $sendAlert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SendAlert  $sendAlert
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            return redirect()->route('sending_alerts.index');
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
