<?php

namespace App\Http\Controllers;

use App\Igss;
use Illuminate\Http\Request;

class IgssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $igss_quota = Igss::where('status',1)
            ->paginate(10)
            ->orderBy('year', 'ASC');

        return view('backend.igss.index', [
                'igss_quota' => $igss_quota,
            ]);

    }

    /**
     * Show the form for creating a new resource.
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Igss  $igss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
