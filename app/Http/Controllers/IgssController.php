<?php

namespace App\Http\Controllers;

use App\Igss;
use Toastr;
use Illuminate\Http\Request;

class IgssController extends Controller
{
    /**
     * Lista los registros existentes en base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $igss_quota = Igss::where('status',1)
            ->paginate(10)
            ->orderBy('year', 'ASC');

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
            'periodo' => 'required|numeric|min:4|max:4',
            'cuota' => 'required|numeric|between:0.00,99.99',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        // Nueva instancia.
        $new_igss = new Igss;

        $new_igss->year = $request->periodo;
        $new_igss->quota = $request->cuota;
        $new_igss->save();



        return redirect()->route('cuotas.index')->with('success', 'Nueva cuota Igss agregada.');
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
        //
    }

    /**
     * Elimina un registro.
     *
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $igss_delete = Igss::findOrFail($id);

        $igss_delete->status = 0;
        $igss_delete->save();

        return redirect()->route('igss-management.index')->with('success','La cuota Igss: '. $igss_delete->quota . ' , ha sido dado de baja!');
    }
}
