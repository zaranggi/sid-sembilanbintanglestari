<?php

namespace App\Modules\Appizin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use App\Modules\Appizin\Models\Appizin;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class AppizinController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param Appizin $data
     */

    public function __construct(Appizin $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listizin();
        return view('Appizin::index',['data' => $data]);
    }

   

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function approve(Request $request)
    {
        $id = $request->id;
        $data = Appizin::findOrFail($id);
        $data->status= 2;
        $data->approval_1 = Auth::user()->name;
        $data->save();
        Session::flash('flash_message', 'Izin berhasil di Setujui!');
        return redirect('appizin');

    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function tolak(Request $request)
    {
        $id = $request->id;
        $data = Appizin::findOrFail($id);
        $data->status= 3;
        $data->approval_1 = Auth::user()->name;
        $data->save();

        Session::flash('flash_message', 'Izin berhasil di tolak!');
        return redirect('appizin');
    }
}
