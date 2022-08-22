<?php

namespace App\Modules\Appmrabr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appmrabr\Models\Appmrabr;
use App\Modules\Mrabr\Models\Mrabr;
use App\Modules\Mrabr\Models\Mrabmaterial;
use App\Modules\Mrabr\Models\Prodmast;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class AppmrabrController extends Controller
{ /**
     * Display a listing of the resource.
     *
     * @param Appmrabp $data
     */

    public function __construct(Appmrabr $data)
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
        return view('Appmrabr::index',["data" => $data]);
    }

    public function approve($id)
    { 
        $upd = $this->data->approve($id);
        
        Session::flash('flash_message', 'RAB sudah di Approve!');
        return redirect('appmrabr');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);
        
        Session::flash('flash_message', 'RAB sudah di Reject!');
        return redirect('appmrabr');

    }
	
	public function view($id)
    { 
        $material = $this->data->rabm($id); 
	   
       $setjob = $this->data->viewjob($id);
      
       $data = Mrabr::findOrFail($id);
        
       return view('Appmrabr::view', [ 
                                   'id' => $id,
                                   'material' => $material,
                                   'setjob' =>$setjob								
                               ])->with('data', $data);
								 
	}

}
