<?php

namespace App\Modules\Dafrekanan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Dafrekanan\Models\Dafrekanan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class DafrekananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Dafrekanan $data
     */
    public function __construct(Dafrekanan $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $data = Dafrekanan::all();
        return view("Dafrekanan::index", ['data' => $data]);
    }


    public function create()
    {
      
        return view("Dafrekanan::create");
        
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
            return Redirect::to('dafrekanan/create')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = new Dafrekanan;
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active;
            
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('dafrekanan');

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

        $menu = Dafrekanan::findOrFail($id);

        return view("Dafrekanan::edit")->with('menu', $menu);

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
            return Redirect::to('dafrekanan/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            
            $data = Dafrekanan::findOrFail($id);
            $data->nama 	= $request->input('nama');
            $data->alamat 		= $request->input('alamat');
            $data->kontak 		= $request->input('kontak');
            $data->status 		= $active; 
            $data->save();
            //	echo $auth_access;

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('dafrekanan');

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
        $menu = Dafrekanan::findOrFail($id);
        $menu->status = "N";
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('dafrekanan');
    }

}
