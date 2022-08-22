<?php

namespace App\Modules\Appmundur\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appmundur\Models\Appmundur; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 
use App\Modules\Booking\Models\Booking; 
use App\Modules\Munit\Models\Munit; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class AppmundurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Appmundur $data
     */

    public function __construct(Appmundur $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listall();
        return view('Appmundur::index',["data" => $data]);
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
            'id_spr' => 'required|max:255', 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('mundur/create')->withErrors($validator)->withInput();
        }
        else
        {  
            $id_mundur = $request->input("id_mundur");
            $id_spr = $request->input("id_spr");

                $data = Appmundur::findOrFail($request->input("id_mundur"));
                $data->pengembalian 	= str_replace(",","",$request->input("pengembalian"));
                $data->status = 2;
                $data->save();  
 
                Booking::where('id_spr', $id_spr)
                    ->update(['status_spr' => 0]);

                    $upd_spr = Trxkonsumen::findOrFail($id_spr);
                    $upd_spr->status_spr = 0;
                    $upd_spr->save();
    
                    $upd_spr = Munit::findOrFail($upd_spr->id_kav);
                    $upd_spr->status = 1;
                    $upd_spr->save();
                Session::flash('flash_message', 'Data has ben successful Updated!');
                return redirect('appmundur');

        }
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function edit($id)
    {
        $data = $this->data->datanya($id);

        return view('Appmundur::edit',['id_spr' => $id, 'data' => $data]);

    }



     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $id_spr = $request->input("query");
        
        $data = $this->data->datanya($id_spr);

        return response()->json($data); 

    }

 
  
}
