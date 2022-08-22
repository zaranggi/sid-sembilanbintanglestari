<?php

namespace App\Modules\Appmrabnew\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appmrabnew\Models\Appmrabnew;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Auth;

class AppmrabnewController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Appmrabnew $data
     */

    public function __construct(Appmrabnew $data)
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
        return view('Appmrabnew::index',["data" => $data]);
    }

    public function approve($id)
    {
        $upd = $this->data->approve($id);

        Session::flash('flash_message', 'RAB sudah di Approve!');
        return redirect('appmrabnew');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);

        Session::flash('flash_message', 'RAB sudah di Reject!');
        return redirect('appmrabnew');

    }

	public function view($id)
    {
       $data = Appmrabnew::findOrFail($id);

       return view('Appmrabnew::view', [
                                   'id' => $id
                               ])->with('data', $data);

	}

}
