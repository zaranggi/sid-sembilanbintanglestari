<?php

namespace App\Modules\Notaris\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Notaris\Models\Notaris;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NotarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Notaris $data
     */
    public function __construct(Notaris $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $data = Notaris::all();
        return view("Notaris::index", ['data' => $data]);
    }


    public function create()
    {
      
        return view("Notaris::create");
        
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
            return Redirect::to('notaris/create')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = new Notaris;
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active;
            
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('notaris');

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

        $menu = Notaris::findOrFail($id);

        return view("Notaris::edit")->with('menu', $menu);

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
            return Redirect::to('notaris/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = Notaris::findOrFail($id);
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active; 
            $data->save();
            //	echo $auth_access;

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('notaris');

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
        $menu = Notaris::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('notaris');
    }

}
