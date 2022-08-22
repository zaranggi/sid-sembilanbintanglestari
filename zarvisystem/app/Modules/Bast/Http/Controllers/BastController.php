<?php

namespace App\Modules\Bast\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Bast\Models\Bast;
use App\Modules\Trxkonsumen\Models\Konsumenlog;
use App\Modules\Trxkonsumen\Models\Trxkonsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BastController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @param Bast $data
     */

    public function __construct(Bast $data)
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
        return view('Bast::index',['data' => $data]);
    }

     
    public function listall($id)
    {
        $data = $this->data->listall($id);
        return view('Bast::data',['data' => $data]);
    }
	
    public function simpan(Request $request)
    {
		
        $data = Trxkonsumen::findOrfail($request->input('id_spr'));
		
		$insert = new Bast;
		$insert->id_spr = $data->id;
		$insert->tanggal = $request->input('tanggal');
		$insert->keterangan = $request->input('keterangan');
        $insert->created_by = Auth::user()->name;

        $path = 'image/surat'; 
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            echo $request->file('file');

            if($request->hasFile('file')){
            
                $file = $request->file('file');

                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $file->move($path, $name);

                $insert->file = $name; 
            }
            
            if($request->hasFile('file2')){
            
                $file = $request->file('file2');

                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $file->move($path, $name);

                $insert->file2 = $name;
                 
            }
            if($request->hasFile('file3')){
            
                $file = $request->file('file3');

                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $file->move($path, $name);

                $insert->file3 = $name;
                
        
            }

		$insert->save();
		return Redirect::to('bast/listall/'.$data->id_properti);
    }


}
