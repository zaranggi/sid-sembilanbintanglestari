<?php

namespace App\Modules\Hiscuti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Hiscuti\Models\Hiscuti; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class HiscutiController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @param Hiscuti $data
     */

    public function __construct(Hiscuti $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {	
		$data = Hiscuti::where("id_user","=",Auth::user()->id)->orderBy("id","desc")->get();
        return view('Hiscuti::index',['data' => $data]);
    }

     
}
