<?php

namespace App\Modules\Appspk\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Appspk\Models\Appspk;
use App\Modules\Konsumen\Models\Konsumen;
use App\Modules\Appspk\Models\Termin;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

use App\Modules\Progbangun\Models\Progbangun;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AppspkController extends Controller
{
       /**
     * Display a listing of the resource.
    *
    * @param Appspk $data
    */

    public function __construct(Appspk $data)
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
        return view('Appspk::index',['data' =>$data]);
    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('Appspk::edit');
    }

    public function approve($id)
    {
        $upd = $this->data->approve($id);

        Session::flash('flash_message', 'SPK sudah diApprove!');
        return redirect('appspk');


    }
    public function reject($id)
    {
        $upd = $this->data->reject($id);

        Session::flash('flash_message', 'SPK sudah diReject!');
        return redirect('appspk');

    }


    public function detail($id)
    {
        $data = $this->data->spk($id);
        $termin = $this->data->termin($id);
        $job = $this->data->job($id);

        return view('Appspk::detail',['data' =>$data, 'termin' => $termin, 'job' => $job]);

    }



}
