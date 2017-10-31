<?php

namespace App\Http\Controllers;

use App\Record;
use Validator;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;
//use Request;
use Carbon\Carbon;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $id)
    {
        /**
         * Editar un registro de la tabla de historial de isr.
         * Datos capturados: id_record, bono, isr.
         */
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }

    /**
         * Editar un registro Record.
         */
        
        
        // $id = $request->id;
        // $bono = $request->bono;
        // $isr = $request->isr;

    public function setUpdateRecord(Request $request)
    {
        
        if ($request->ajax()) 
        {
            $v = Validator::make($request->all(), [                
                '_bono' => 'required|numeric|between:250.00,10000.00',
                '_isr' => 'required|numeric|between:10.00,10000.00',              
            ]);

            if ($v->fails()) 
            {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }
            # code...
            try {
                $dt = Carbon::now();
                $date_save = $dt->toDateString();


                $id = intval($request->_id);
                $empl_id = intval($request->_emp_id);
                $bonus = floatval($request->_bono);
                $isr = floatval($request->_isr);                        
            
                $edit_record = Record::findOrFail($id);
                $edit_record->employee_id = $empl_id;
                $edit_record->bonus = $bonus; //$new_bonus;                
                $edit_record->isr = $isr; // $new_isr;                

                $edit_record->save();

                $msg = "Actualización Exitosa";
                return response()->json(['msg' => $msg]);
                //return response()->json($edit_record);
            } catch (\Exception $e) {
                return redirect()->route('error')->with('error','Ha sucedido un error.');            
            }
        
        
        }
    }

} // fin de clase
