<?php

namespace App\Modules\Wacontact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Wacontact\Models\Wacontact;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class WacontactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Wacontact $data
     */
    public function __construct(Wacontact $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $data = Wacontact::all();
        return view("Wacontact::index", ['data' => $data]);
    }


    public function create()
    {
      
        return view("Wacontact::create");
        
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
            'kontak' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('wacontact/create')->withErrors($validator)->withInput();
        }
        else
        { 
            $data = new Wacontact;
            $data->nama 	= $request->input('nama'); 
            $data->phone 		= $request->input('kontak'); 
            
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('wacontact');

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

        $menu = Wacontact::findOrFail($id);

        return view("Wacontact::edit")->with('menu', $menu);

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
        'kontak' => 'required',
    );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('wacontact/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        { 
            
            $data = Wacontact::findOrFail($id);
            $data->nama 	= $request->input('nama'); 
            $data->phone 		= $request->input('kontak'); 
            $data->save();
            //	echo $auth_access;

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('wacontact');

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
        $menu = Wacontact::findOrFail($id); 
        $menu->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('wacontact');
    }

}
