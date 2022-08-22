<?php

namespace App\Modules\Appcuti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appcuti\Models\Appcuti;

use App\Modules\Cuti\Models\Cutisaldo;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class AppcutiController extends Controller
{
    
      /**
     * Display a listing of the resource.
     *
     * @param Appcuti $data
     */

    public function __construct(Appcuti $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listcuti();
        return view('Appcuti::index',['data' => $data]);
    }

   

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function approve(Request $request)
    {
        $id = $request->id;
        $data = Appcuti::findOrFail($id);
        $data->status= 2;
        $data->approval_1 = Auth::user()->name;
        $data->save();

        if($data->jenis_cuti == "Cuti Tahunan"){
            $u = Cutisaldo::findOrFail($data->id_user);
            $u->saldo_akh = $u->saldo_akh - $data->total_cuti;
            $u->dipakai = $u->dipakai + $data->total_cuti;
            $u->save();    
        }
        
        Session::flash('flash_message', 'Cuti berhasil di Setujui!');
        return redirect('appcuti');

    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function tolak(Request $request)
    {
        $id = $request->id;
        $data = Appcuti::findOrFail($id);
        $data->status= 3;
        $data->approval_1 = Auth::user()->name;
        $data->save();

        Session::flash('flash_message', 'Cuti berhasil di tolak!');
        return redirect('appcuti');
    }

      
}
