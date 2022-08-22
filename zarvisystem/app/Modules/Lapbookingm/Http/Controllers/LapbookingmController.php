<?php

namespace App\Modules\Lapbookingm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Lapbookingm\Models\Lapbookingm; 
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Munit\Models\Munit; 
use App\Modules\Mproperti\Models\Mproperti; 
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
class LapbookingmController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Lapbookingm $data
     */

    public function __construct(Lapbookingm $data)
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
        return view('Lapbookingm::index',['data' => $data, 'marketing' => $marketing]);
		 
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
     public function preview(Request $request)
    {
		 $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");
        $id_properti = $request->input("id_properti");
        $id_marketing = $request->input("id_marketing");

        $data = $this->data->listall($tanggal1,$tanggal2,$id_properti,$id_marketing);
        return view('Lapbookingm::preview',['data' => $data,'tanggal1' => $tanggal1 ,'tanggal2' => $tanggal2]);
		
       
        
    }
    
}
