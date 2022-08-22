<?php

namespace App\Modules\Lognya\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Booking\Models\Mtran;
use Illuminate\Support\Facades\DB;
class LognyaController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param Mtran $data
     */

    public function __construct(Mtran $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Mtran::select(DB::raw("
                mtran.*, properti.nama as nama_properti, properti_kav.nama as nama_kav"))
                ->leftjoin("properti","mtran.id_properti","=","properti.id")
                ->leftjoin("properti_kav","mtran.id_kav","=","properti_kav.id")
                ->orderby("id","desc")
                ->take(100)
                ->get();
        Mtran::where("isread", 0)->update(['isread' => 1]);

        return view('Lognya::index', ['data' => $data]);
    }

     
}
