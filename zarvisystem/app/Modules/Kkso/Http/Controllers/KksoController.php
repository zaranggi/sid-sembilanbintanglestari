<?php

namespace App\Modules\Kkso\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Kkso\Models\Kkso;
 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KksoController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Konsumen $data
     */

    public function __construct(Kkso $data)
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
        
        return view("Kkso::index", ['data' => $data]); 
    }

    
}
