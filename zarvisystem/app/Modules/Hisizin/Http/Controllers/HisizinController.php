<?php

namespace App\Modules\Hisizin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Hisizin\Models\Hisizin; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class HisizinController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @param Hisizin $data
     */

    public function __construct(Hisizin $data)
    {
        $this->data = $data;
    }
	
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$data = Hisizin::where("id_user","=",Auth::user()->id)->orderBy("id","desc")->get();
        return view('Hisizin::index', ['data' => $data]);
    }

    
}
