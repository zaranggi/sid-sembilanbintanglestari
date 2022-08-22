<?php

namespace App\Modules\Jenislegal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Jenislegal\Models\Jenislegal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class JenislegalController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @param Jenislegal $data
     */

    public function __construct(Jenislegal $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Jenislegal::All();
        return view('Jenislegal::index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        
        return view('Jenislegal::create'); 

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'jenis_legalformal' => 'required|max:255', 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('Jenislegal/create')->withErrors($validator)->withInput();
        }
        else
        {
            $data = new Jenislegal;
            $data->jenis_legalformal 	        = $request->input('jenis_legalformal'); 
            $data->save();

            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('Jenislegal');

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('Jenislegal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Jenislegal::findOrFail($id); 

        return view("Jenislegal::edit")->with('data', $data); 
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
            'jenis_legalformal' => 'required|max:255', 
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('Jenislegal/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            
            $data = Jenislegal::findOrFail($id); 
            $data->jenis_legalformal 	        = $request->input('jenis_legalformal');  
            $data->save();

            //	echo $auth_access;

            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('jenislegal');

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Jenislegal::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has been successful Deleted!');
        return redirect('jenislegal');
    }
}
