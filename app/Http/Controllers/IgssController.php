<?php

namespace App\Http\Controllers;

use App\Igss;
use Validator;
use Alert;
use Illuminate\Http\Request;

class IgssController extends Controller
{
    /**
     * Lista los registros existentes en base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request->get('cuota'));
        $cuota_search = trim($request->get('cuota'));

        $igss_quota = Igss::buscar($cuota_search)->where('status',1)
            ->orderBy('year')
            ->paginate(10);

            return view('backend.igss.index', [
                'igss_quota' => $igss_quota,
            ]);    
    }

    /**
     * Muestra vista para crear cuota.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('backend.igss.create');
    }

    /**
     * Valida datos y crea un registro nuevo de cuota Igss.
     * Campos: year, cuota.
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
            'periodo' => 'required|digits_between:4,4|numeric',
            'cuota' => 'required|numeric|between:4.00,99.99',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        /**
         * Validar si existe un registro, para el año elegido.
         * @var periodo
         */
        $result = $this->getVerifyExistsData($request->periodo);

        if ($result) {
            Alert::error('Solo puede registrar una cuota IGSS por año. Elija un año diferente.', 'Cuota Existente');
            return redirect()->back()->withInput();
        }else{
            // Agregar nueva cuota.
            $new_igss = new Igss;
            $new_igss->year = $request->periodo;
            $new_igss->quota = $request->cuota;
            $new_igss->save();

            Alert::success('Ha agregado una nueva Cuota IGSS.', 'Nueva Cuota');
            return redirect()->route('cuotas.index'); 
        }
    }

    /**
     * Muestra vista con registro individual.
     *
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 
     * Editar un registro existente de cuota Igss, 
     * recibe como parametro el id del registro.
     * Busca y retorna una vista con los datos encontrados.
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $igss_edit = Igss::findOrFail($id);

        return view('backend.igss.edit', [
                'igss_edit' => $igss_edit,
            ]);        
    }

    /**
     * Actualiza datos recibidos desde frontend
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Igss  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * Reglas de validacion de datos y validación.
         */
        $validator = Validator::make( $request->all(), [
            'periodo' => 'required|digits_between:4,4|numeric',
            'cuota' => 'required|numeric|between:4.00,99.99',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        // Consultar si existe un registro que coincide con el año.
        $result = $this->getVerifyExistsData($request->periodo);
        
        if ($result)
        {
            // Actualizar solo cuota.
            $edit_igss = Igss::findOrFail($id);
            //$edit_igss->year = $request->periodo;
            $edit_igss->quota = $request->cuota;
            $edit_igss->save();
        
            Alert::success('Se ha actualizado solo la Cuota Igss.', 'Cuota IGSS');
            return redirect()->route('cuotas.index');
        }else
            {
                // Actualizar cuota y año.
                $edit_igss = Igss::findOrFail($id);
                $edit_igss->year = $request->periodo;
                $edit_igss->quota = $request->cuota;
                $edit_igss->save();

                Alert::success('Se ha actualizado la Cuota y Año.', 'Cuota IGSS');
                return redirect()->route('cuotas.index');
            }
    }

    /**
     * Eliminar un registro.
     *
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $igss_delete = Igss::findOrFail($id);

        $igss_delete->status = 0;
        $igss_delete->save();
       
        Alert::success('Ha eliminado la Cuota IGSS elegida.', 'Eliminar');        
        return redirect()->route('cuotas.index');
    }

    /**
     * Al momento de crear:
     * getVerifyExistsData: verifica si existe un registro de Igss con el mismo año.
     * Si existe, no dejerá crear otro con el mismo año.
     *
     * Sino existe el registro, se procede a crear una nueva cuota.
     *
     * Al momento de actualizar.
     * Si existe un registro, solo actualizará la cuota, manteniendo el año.
     *
     * Sino existe el registro, se procede a actualizar el año y la cuota.
     * 
     * @param  $year 
     * @return boolean true|false
     */
    private function getVerifyExistsData($year)
    {                
         $result_value = false;
        
        // Buscar coincidencia.
        $igss = Igss::where('year', $year)
                    ->where('status', 1)
                    ->first();
        if ($igss)        
            return $result_value = true;    
        else        
            return $result_value; 
    }
}
