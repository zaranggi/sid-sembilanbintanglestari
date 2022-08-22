<?php

namespace App\Modules\Appspkrev\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appspkrev\Models\Appspkrev; 
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Appspkrev\Models\Termin; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class AppspkrevController extends Controller
{   /**
     * Display a listing of the resource.
    *
    * @param Appspkrev $data
    */

    public function __construct(Appspkrev $data)
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
        return view('Appspkrev::index',['data' =>$data]);
    }

     

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('Appspkrev::edit');
    }
    
    public function approve($id)
    { 
        $upd = $this->data->approve($id);
        
        Session::flash('flash_message', 'SPK sudah diApprove!');
        return redirect('appspkrev');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);
        
        Session::flash('flash_message', 'SPK sudah diReject!');
        return redirect('appspkrev');

    }
	
	
    public function detail($id)
    {
        $data = $this->data->spkdetail($id);
        $termin = $this->data->termindetail($id);
        $job = $this->data->jobdetail($id);
          
        return view('Appspkrev::detail',['data' =>$data, 'termin' => $termin, 'job' => $job]);

    }
}
