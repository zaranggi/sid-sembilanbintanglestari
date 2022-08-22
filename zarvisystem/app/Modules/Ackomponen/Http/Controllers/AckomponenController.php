<?php

namespace App\Modules\Ackomponen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use App\Modules\Ackomponen\Models\Ackomponen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AckomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Acklasifikasi $data
     */

    public function __construct(Ackomponen $data)
    {
        $this->data = $data;
    }

    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Ackomponen::where("id_komponen","=",0)->where("id_klasifikasi","=",0)->orderBy("id")->get();
        return view('Ackomponen::index', ['listdata' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
       
        return view('Ackomponen::create');
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
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('ackomponen/create')->withErrors($validator)->withInput();
        }
        else
        {
            $data = new Ackomponen;
            $data->nama_akun 	        = $request->input('nama'); 
            $data->id_komponen          	= 0;
            $data->id_klasifikasi          	= 0;
            $data->posting 		= $request->input('posting'); 
            $data->kat 		= $request->input('kat'); 
            $data->save();

            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('ackomponen');

        }
        //
    }

  

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Ackomponen::findOrFail($id);

       
        return view("ackomponen::edit")->with('data', $data);
 
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
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('ackomponen/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            
            $data = Ackomponen::findOrFail($id); 
            $data->nama_akun 	        = $request->input('nama'); 
            $data->id_komponen          	= 0;
            $data->id_klasifikasi          	= 0;
            $data->posting 		= $request->input('posting'); 
            $data->kat 		= $request->input('kat'); 
            $data->save();

            //	echo $auth_access;

            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('ackomponen');

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
        $menu = Ackomponen::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has been successful Deleted!');
        return redirect('ackomponen');
    }

}
