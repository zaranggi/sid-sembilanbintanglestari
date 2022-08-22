<?php

namespace App\Modules\Appbebaslahan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Appbebaslahan\Models\Appbebaslahan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Mail;

class AppbebaslahanController extends Controller
{

    /* Display a listing of the resource.
     *
     * @param Appbebaslahan $data
     */

    public function __construct(Appbebaslahan $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->listdata();

        return view('Appbebaslahan::index', ['data' => $data]);
    }

    public function create()
    {
        $properti = $this->data->dataproperti();

        return view('Appbebaslahan::create', ['properti' => $properti]);
    }

    public function simpan(Request $request)
    {


    }

    public function update(Request $request)
    {


    }

    public function approve($id)
    {
        $upd = $this->data->approve($id);

        Session::flash('flash_message', 'Pengajuan sudah diApprove!');
        return redirect('appbebaslahan');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);

        Session::flash('flash_message', 'Pengajuan sudah diReject!');
        return redirect('appbebaslahan');

    }

    public function detail($id)
    {
        $properti = $this->data->dataproperti();
        $data = $this->data->detail($id);
        $termin = $this->data->gettermin($id);
        return view('Appbebaslahan::detail', ['properti' => $properti, 'data'=> $data, 'id' => $id, 'termin' => $termin]);
    }

    public function doc($id)
    {
        $data = $this->data->listdoc($id);
        return view('Appbebaslahan::doc', ['listdoc' => $data, 'id'=>$id]);
    }

    public function uploaddoc(Request $request)
    {

    }


}
