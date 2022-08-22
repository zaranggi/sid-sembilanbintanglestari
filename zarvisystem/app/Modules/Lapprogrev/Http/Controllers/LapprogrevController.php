<?php

namespace App\Modules\Lapprogrev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Lapprogrev\Models\Lapprogrev;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;


class LapprogrevController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @param Lapprogrev $data
     */

    public function __construct(Lapprogrev $data)
    {
        $this->data = $data;
    }
	
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->perumahan();
        
        return view("Lapprogrev::index", ['data' => $data]);
 
    }

  /**
     * Display a listing of the resource.
     * @return Response
     */
    public function data($id_properti)
    {
		//$perumahan =  $this->data->nama_perumahan($id_properti);
        $data = $this->data->dataall($id_properti);      

        return view("Lapprogrev::data", 
                            [
                                'data' => $data
                                    
                            ]);
 
    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {
		$data = $this->data->spk($id);
		  
		return view("Lapprogrev::edit",['data' => $data ]);

    }
	
 
}
