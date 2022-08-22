<?php

namespace App\Modules\Rfollowup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Rfollowup\Models\Rfollowup;
use App\Modules\Users\Models\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;

class RfollowupController extends Controller
{

    
     /**
     * Display a listing of the resource.
     *
     * @param Mproperti $data
     */

    public function __construct(Rfollowup $data)
    {
        $this->data = $data;
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Mproperti::OrderBy('created_at','desc')->get();
        $marketing = Users::where('id_jabatan','=','9')->get();
        return view('Rfollowup::index',['data' => $data, 'marketing' => $marketing]);

    }

    public function preview(Request $request)
    {
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti");
        $id_marketing = $request->input("id_marketing");

        $data = $this->data->listall($tanggal1,$tanggal2,$id_properti,$id_marketing);

        
        return view('Rfollowup::preview',['data' => $data, 'tanggal1' => $tanggal1, 'tanggal2' => $tanggal2 ]);


    }

     
}
