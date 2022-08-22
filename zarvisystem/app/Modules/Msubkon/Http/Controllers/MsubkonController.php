<?php

namespace App\Modules\Msubkon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Msubkon\Models\Msubkon;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class MsubkonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Msubkon $data
     */
    public function __construct(Msubkon $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $data = Msubkon::all();
        return view("Msubkon::index", ['data' => $data]);
    }


    public function create()
    {
      
        return view("Msubkon::create");
        
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'kontak' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('msubkon/create')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = new Msubkon;
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active;
            
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('msubkon');

        }
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {

        $menu = Msubkon::findOrFail($id);

        return view("Msubkon::edit")->with('menu', $menu);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update($id, Request  $request)
    {  $rules = array(
        'nama' => 'required|max:255',
        'alamat' => 'required',
        'kontak' => 'required',
    );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('msubkon/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = Msubkon::findOrFail($id);
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active; 
            $data->save();
            //	echo $auth_access;

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('msubkon');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    {
        $menu = Msubkon::findOrFail($id);
        $menu->status = "N";
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('msubkon');
    }

}
