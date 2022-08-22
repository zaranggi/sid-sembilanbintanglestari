<?php

namespace App\Modules\Ckonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Ckonsumen\Models\Ckonsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CkonsumenController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Ckonsumen $data
     */

    public function __construct(Ckonsumen $data)
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
        
        return view("Ckonsumen::index", ['data' => $data]);
 
    }

    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function datakonsumen($id)
    {
        $data = $this->data->listkonsumen($id);      

        return view("Ckonsumen::datakonsumen", 
                            [
                                'data' => $data,
                                'id_properti' => $id
                                    
                            ]);
 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function tambah($id)
    { 

        return view("Ckonsumen::tambah", 
                            [
                                'id_properti' => $id, 
                                    
                            ]);
 
    }
 
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function saveadd(Request $request)
    {
        $rules = array(
            'nama' => 'required|max:50',
            'alamat' => 'required', 
            'telp' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            
            return Redirect::to('ckonsumen/tambah/'.$request->input('id_properti'))->withErrors($validator)->withInput();
        }
        else
        {
            
            
            $gaji = str_replace(",","",$request->input('gaji'));
            $gaji_pasangan = str_replace(",","",$request->input('gaji_pasangan'));
            $idcard = str_replace(" ","",$request->input('idcard'));
            $npwp = str_replace(" ","",$request->input('npwp'));
            
            $noUrutAkhir = Ckonsumen::max('id');
            $kode = "KO-".sprintf("%04s", $noUrutAkhir + 1);

            $menu = new Ckonsumen; 
            $menu->id_properti      = $request->input('id_properti');
            $menu->id_marketing     = Auth::user()->id;
            $menu->kode             = $kode;            
            $menu->nama         	= $request->input('nama');
            $menu->alamat 	        = $request->input('alamat');
            $menu->email 	        = $request->input('email');
            $menu->idcard 	        = $idcard ;
            $menu->npwp 	        = $npwp;
            $menu->telp          	= $request->input('telp');  
            $menu->pekerjaan        = $request->input('pekerjaan');  
            $menu->nama_kantor      = $request->input('nama_kantor');  
            $menu->alamat_kantor    = $request->input('alamat_kantor');  
            $menu->telp_kantor      = $request->input('telp_kantor');  
            $menu->ket_kerja      = $request->input('ket_kerja');  
            $menu->gaji          	= $gaji;  
            $menu->gaji_pasangan          	= $gaji_pasangan;  
            $menu->nama_pasangan        = $request->input('nama_pasangan');  
            $menu->alamat_pasangan      = $request->input('alamat_pasangan');  
            $menu->telp_pasangan        = $request->input('telp_pasangan');  
            $menu->pekerjaan_pasangan   = $request->input('pekerjaan_pasangan');  
            $menu->ket_pasangan         = $request->input('ket_pasangan');              
            $menu->nama_keluarga        = $request->input('nama_keluarga');  
            $menu->alamat_keluarga      = $request->input('alamat_keluarga');  
            $menu->telp_keluarga        = $request->input('telp_keluarga');  
            $menu->hubungan             = $request->input('hubungan');  
            $menu->ket_keluarga         = $request->input('ket_keluarga'); 
            $menu->created_by     = Auth::user()->name;
            $menu->save(); 
            
            /*
            $t = count($request->input('document', []));
            if($t > 0){
                
                foreach ($request->input('document', []) as $file) {

                    $img = new Kavimg; 
                    $img->id_kav      = $menu->id;
                    $img->gambar 	  = $file; 
                    $img->save(); 

                }
            }
            */

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('ckonsumen/data/'.$request->input('id_properti'));
             

        }
    }

    

    public function simpangambar(Request $request)
    {
        $path ='image/dockonsumen';

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    } 

     
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Ckonsumen::findOrFail($id);
         

        return view("Ckonsumen::edit")->with('data', $data); 

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
            'nama' => 'required|max:50',
            'alamat' => 'required', 
            'telp' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('ckonsumen/'.$id.'/edit')->withErrors($validator)->withInput();  
        }
        else
        {
             
            $gaji = str_replace(",","",$request->input('gaji'));
            $gaji_pasangan = str_replace(",","",$request->input('gaji_pasangan'));
            $idcard = str_replace(" ","",$request->input('idcard'));
            $npwp = str_replace(" ","",$request->input('npwp')); 

            $menu = Ckonsumen::findOrFail($id);
            //$menu->id_properti      = $request->input('id_properti');
            //$menu->id_marketing     = Auth::user()->id;
            //$menu->kode             = $kode;            
            $menu->nama         	= $request->input('nama');
            $menu->alamat 	        = $request->input('alamat');
            $menu->email 	        = $request->input('email');
            $menu->idcard 	        = $idcard ;
            $menu->npwp 	        = $npwp;
            $menu->telp          	= $request->input('telp');  
            $menu->pekerjaan        = $request->input('pekerjaan');  
            $menu->nama_kantor      = $request->input('nama_kantor');  
            $menu->alamat_kantor    = $request->input('alamat_kantor');  
            $menu->telp_kantor      = $request->input('telp_kantor');  
            $menu->ket_kerja        = $request->input('ket_kerja');  
            $menu->gaji          	= $gaji;  
            $menu->gaji_pasangan          	= $gaji_pasangan;  
            $menu->nama_pasangan        = $request->input('nama_pasangan');  
            $menu->alamat_pasangan      = $request->input('alamat_pasangan');  
            $menu->telp_pasangan        = $request->input('telp_pasangan');  
            $menu->pekerjaan_pasangan   = $request->input('pekerjaan_pasangan');  
            $menu->ket_pasangan         = $request->input('ket_pasangan');              
            $menu->nama_keluarga        = $request->input('nama_keluarga');  
            $menu->alamat_keluarga      = $request->input('alamat_keluarga');  
            $menu->telp_keluarga        = $request->input('telp_keluarga');  
            $menu->hubungan             = $request->input('hubungan');  
            $menu->ket_keluarga         = $request->input('ket_keluarga');  
            $menu->save(); 
            
            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('ckonsumen/data/'.$request->input('id_properti'));
             

        }

    }

   
 
}
