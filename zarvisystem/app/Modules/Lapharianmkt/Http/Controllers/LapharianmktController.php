<?php

namespace App\Modules\Lapharianmkt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller; 

use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Lapharianmkt\Models\Lapharianmkt;
use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;

class LapharianmktController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @param Lapharianmkt $data
    */

    public function __construct(Lapharianmkt $data)
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
        return view('Lapharianmkt::index',['data' => $data, 'marketing' => $marketing]);     
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Lapharianmkt::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('Lapharianmkt::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('Lapharianmkt::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
