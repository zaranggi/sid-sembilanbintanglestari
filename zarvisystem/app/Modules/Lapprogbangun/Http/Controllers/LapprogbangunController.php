<?php

namespace App\Modules\Lapprogbangun\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Lapprogbangun\Models\Lapprogbangun;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;


class LapprogbangunController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @param Lapprogbangun $data
     */

    public function __construct(Lapprogbangun $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->perumahan();

        return view("Lapprogbangun::index", ['data' => $data]);

    }

  /**
     * Display a listing of the resource.
     * @return Response
     */
    public function data($id_properti)
    {
		$perumahan =  $this->data->nama_perumahan($id_properti);
        $data = $this->data->dataall($id_properti);

        return view("Lapprogbangun::data",
                            [
								'perumahan' => $perumahan,
                                'data' => $data

                            ]);

    }
	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {

		$data = $this->data->detail($id);


		return view("Lapprogbangun::edit",['data' => $data, 'id' => $id]);

    }


}
