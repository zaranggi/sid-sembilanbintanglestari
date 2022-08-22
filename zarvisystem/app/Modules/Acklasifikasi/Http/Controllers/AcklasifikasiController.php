<?php

namespace App\Modules\Acklasifikasi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Acklasifikasi\Models\Acklasifikasi;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AcklasifikasiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Acklasifikasi $data
     */

    public function __construct(Acklasifikasi $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->dataall();
        return view('Acklasifikasi::index', ['listdata' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = Acklasifikasi::where("id_komponen","=",0)->where("id_klasifikasi","=",0)->get();
        return view('Acklasifikasi::create',['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama' => 'required|max:255', 
            'id_komponen' => 'required|numeric', 
            'kode' => 'required|numeric', 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('acklasifikasi/create')->withErrors($validator)->withInput();
        }
        else
        {
            $data = new Acklasifikasi;
            $data->nama_akun 	        = $request->input('nama');
            $data->kode          	= $request->input('kode');
            $data->id_komponen          	= $request->input('id_komponen');
            $data->id_klasifikasi          	= 0;
            $data->posting 		= $request->input('posting'); 
            $data->kat 		= $request->input('kat'); 
            $data->save();

            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('acklasifikasi');

        }
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('bank::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Acklasifikasi::findOrFail($id);

        $data_komponen = Acklasifikasi::where("id_komponen","=",0)->where("id_klasifikasi","=",0)->get();

        return view("acklasifikasi::edit", ['data_komponen' => $data_komponen])->with('data', $data);
 
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'nama' => 'required|max:255',
            'id_komponen' => 'required|numeric', 
            'kode' => 'required|numeric', 
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('acklasifikasi/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            
            $data = Acklasifikasi::findOrFail($id); 
            $data->nama_akun 	        = $request->input('nama');
            $data->kode          	= $request->input('kode');
            $data->id_komponen          	= $request->input('id_komponen');
            $data->id_klasifikasi          	= 0;
            $data->posting 		= $request->input('posting'); 
            $data->kat 		= $request->input('kat'); 
            $data->save();

            //	echo $auth_access;

            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('acklasifikasi');

        }
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Acklasifikasi::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has been successful Deleted!');
        return redirect('acklasifikasi');
    }


}
