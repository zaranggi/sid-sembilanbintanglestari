<?php

namespace App\Modules\Akun\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Akun\Models\Akun;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class AkunController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Acklasifikasi $data
     */

    public function __construct(Akun $data)
    {
        $this->data = $data;
    }

     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $komponen = $this->data->komponen();
        foreach($komponen as $r){
            //echo "+ Komponen \ ".$r->nama_akun."<br/>";
            
            $klasifikasi[$r->id] = $this->data->klasifikasi($r->id);
            foreach($klasifikasi[$r->id] as $r2){
                //echo "-- Klasifikasi | ".$r2->nama_akun."<br/>";
                $akun[$r2->id] = $this->data->akun($r->id, $r2->id);
                
                foreach($akun[$r2->id] as $r3){
                   // echo "---- Akun |".$r3->nama_akun."<br/>";
                    $subakun[$r3->id]  = $this->data->subakun($r3->id);
                    foreach( $subakun[$r3->id] as $r4){
                     //   echo "---- -- Sub Akun |".$r4->nama_akun."<br/>";
                        
                    }

                }
                
            }

        } 
 
        return view('Akun::index', 
        [
            'komponen' => $komponen,
            'klasifikasi' => $klasifikasi,
            'akun' => $akun,
            'subakun' => $subakun,
        
        ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data_komponen = Akun::where("id_komponen","=",0)->get();
        $data_klasifikasi = Akun::where("id_komponen","<>",0)->where("id_klasifikasi","=",0)->get();
        return view('Akun::create', ['data_komponen' => $data_komponen, 'data_klasifikasi' => $data_klasifikasi]);
    }

    public function listklasifikasi(Request $request)
    {
        $x = $request->id_komponen;
        if($request->ajax()){
            
            $data = Akun::where("id_komponen","=", $x)
            ->where("id_klasifikasi","=",0)
            ->get();
            
            return response()->json($data);
        }

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
            'id_klasifikasi' => 'required|numeric',
            'kode' => 'required|numeric', 
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('akun/create')->withErrors($validator)->withInput();
        }
        else
        {

            $idklasifikasi = $request->input('id_klasifikasi');
            if($idklasifikasi == 00){
                $fix = 0;
                $kode = $request->input('id_komponen')."00".$request->input('kode');;
            }else{
                
                $x = Akun::where("kode","=","$idklasifikasi")->get();
                foreach($x as $r){
                    $fix = $r->id;
                }
                $kode = $request->input('id_klasifikasi2').$request->input('kode');
                
            }

            $data = new Akun;
            $data->nama_akun	        = $request->input('nama');
            $data->kode	                = $kode;
            $data->id_komponen	        = $request->input('id_komponen');
            $data->id_klasifikasi	    = $fix;
            $data->kat          	= $request->input('kat');
            $data->posting 		= $request->input('posting'); 
            $data->save();
            
            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('akun');

        }
        //
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Akun::findOrFail($id);
        $data_komponen = Akun::where("id_komponen","=",0)->get();
        $data_klasifikasi = Akun::where("id_komponen","<>",0)->where("id_klasifikasi","=",0)->get(); 

        return view("akun::edit", ['data_klasifikasi' => $data_klasifikasi, 'data_komponen' => $data_komponen])
                    ->with('data', $data);

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
            'id_klasifikasi' => 'required|numeric',
            'kode' => 'required|numeric', 
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('akun/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            $idklasifikasi = $request->input('id_klasifikasi');
            if($idklasifikasi == 00){
                $fix = 0;
                $kode = $request->input('id_komponen')."00".$request->input('kode');;
            }else{
                
                $x = Akun::where("kode","=","$idklasifikasi")->get();
                foreach($x as $r){
                    $fix = $r->id;
                }
                $kode = $request->input('id_klasifikasi2').$request->input('kode');
                
            } 
            
            $data = Akun::findOrFail($id);   
            $data->nama_akun	        = $request->input('nama');
            $data->kode	                = $kode;
            $data->id_komponen	        = $request->input('id_komponen');
            $data->id_klasifikasi	    = $fix;
            $data->kat          	= $request->input('kat');
            $data->posting 		= $request->input('posting'); 
            $data->save();
            
            
            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('akun');

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
        $menu = Akun::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has been successful Deleted!');
        return redirect('akun');
    }

 
}
