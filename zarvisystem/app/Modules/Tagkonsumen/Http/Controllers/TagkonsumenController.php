<?php

namespace App\Modules\Tagkonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Tagkonsumen\Models\Tagkonsumen; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TagkonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Tagkonsumen $data
     */

    public function __construct(Tagkonsumen $data)
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
        return view('Tagkonsumen::index',['data' => $data]);
    }


    public function listall($id_properti)
    {
        $data = $this->data->listall($id_properti);
        return view('Tagkonsumen::data',['data' => $data]);
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->data->datanya($id);

        return view('Tagkonsumen::edit',['data' => $data]);

         
    }  
 
    
}
