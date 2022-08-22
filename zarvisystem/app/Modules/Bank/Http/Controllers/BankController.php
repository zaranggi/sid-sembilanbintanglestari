<?php

namespace App\Modules\Bank\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Bank\Models\Bank;
use App\Modules\Akun\Models\Akun;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Bank $data
     */

    public function __construct(Bank $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Bank::all();
        return view('Bank::index', ['listbank' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_bank = $this->data->listbank();
        $ak = Akun::where("nama_akun","LIKE","%Bank%")->where("posting","=","D")->get();

        return view('Bank::create', ['data_bank' => $data_bank,'ak' =>$ak])
        ;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nama' => 'required|max:255',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            'acc_kode' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('bank/create')->withErrors($validator)->withInput();
        }
        else
        {
            $data = new Bank;
            $data->nama 	        = $request->input('nama');
            $data->nomor_rekening	= $request->input('nomor_rekening');
            $data->atas_nama 		= $request->input('atas_nama');  
            $data->acc_kode 		= $request->input('acc_kode'); 
            $data->cabang 	= '';
            $data->save();

            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('bank');

        }
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('Bank::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Bank::findOrFail($id);

        $data_bank = $this->data->listbank();
        $ak = Akun::where("nama_akun","LIKE","%Bank%")->where("posting","=","D")->get();

        return view("bank::edit", ['data_bank' => $data_bank,'ak' =>$ak])->with('bank', $data);
 
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'nama' => 'required|max:255',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            'acc_kode' => 'required',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('bank/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            
            $data = Bank::findOrFail($id); 
            $data->nama 	        = $request->input('nama');
            $data->nomor_rekening	= $request->input('nomor_rekening');
            $data->atas_nama 		= $request->input('atas_nama'); 
            $data->acc_kode 		= $request->input('acc_kode'); 
            $data->cabang 	= '';
            $data->save();

            //	echo $auth_access;

            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('bank');

        }
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Bank::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has been successful Deleted!');
        return redirect('bank');
    }
}
