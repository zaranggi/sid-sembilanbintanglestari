<?php

namespace App\Modules\Lapspr\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use App\Modules\Lapspr\Models\Lapspr;

class LapsprController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Lapspr $data
     */

    public function __construct(Lapspr $data)
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
        return view('Lapspr::index', ['data' => $data]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function preview($id)
    {
        $data = $this->data->preview($id);
		$tagihan = $this->data->listtagihan($id);
        return view('Lapspr::preview',['data' => $data, 'tagihan' => $tagihan]);
        
    }
    
    
}
