<?php

namespace App\Modules\Konsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Konsumen\Models\Konsumen;

use App\Modules\Konsumen\Models\Dokumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;

class KonsumenController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @param Konsumen $data
     */

    public function __construct(Konsumen $data)
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
        
        return view("Konsumen::index", ['data' => $data]);
 
    }

    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function datakonsumen($id)
    {
        $data = $this->data->listkonsumen($id);      

        return view("Konsumen::datakonsumen", 
                            [
                                'data' => $data,
                                'id_properti' => $id
                                    
                            ]);
 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function mykonsumen(Request $request)
    {
        $kode = substr($request->kode,0,7);
        $data = $this->data->mykonsumen($kode);      

        return view("Konsumen::mykonsumen", 
                            [
                                'data' => $data
                                    
                            ]);
 
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
        $data = Konsumen::findOrFail($id);

        $listdoc = $this->data->listdoc($id);
        if(count($listdoc) == 0){
            $listdoc = $this->data->listdoc2();
        } 

        return view("Konsumen::edit", [ 'listdoc' => $listdoc])->with('data', $data); 

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
            return Redirect::to('konsumen/'.$id.'/edit')->withErrors($validator)->withInput();  
        }
        else
        {
             
            $gaji = str_replace(",","",$request->input('gaji'));
            $gaji_pasangan = str_replace(",","",$request->input('gaji_pasangan'));
            $idcard = str_replace(" ","",$request->input('idcard'));
            $npwp = str_replace(" ","",$request->input('npwp')); 
            $cekdoc = "";
            $listdoc = $this->data->listdoc2();
            foreach($listdoc as $r){ 

                $path ='image/dockonsumen';
                $file_name = "";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $id_jenis = $r->id_jenis;
                if ($request->hasFile('a'.$id_jenis)) {
                    $file = $request->file('a'.$id_jenis);
                   
                    $a = $idcard."_".$r->id_jenis.".jpg";
     
                    $file_name = uniqid() . '_' . $a;

                    $file->move($path, $file_name); 
                }


                $db = DB::connection('mysql'); 
                $db->insert("REPLACE INTO konsumen_doc 
                            SET id_konsumen='$id', 
                            id_jenis='$id_jenis', 
                            photo=' $file_name',
                            `status`='1',
                            cek='1',
                            created_at=now()");

            }

            if($request->input('lengkap') == "on"){
                $berkas_lengkap = "Lengkap";
            }else{
                $berkas_lengkap = "Belum Lengkap";
            }


            $menu = Konsumen::findOrFail($id);
            //$menu->id_properti      = $request->input('id_properti');
            //$menu->id_marketing     = Auth::user()->id;
            //$menu->kode             = $kode;            
            $menu->nama         	= strtoupper($request->input('nama'));
            $menu->alamat 	        = $request->input('alamat');
            $menu->email 	        = $request->input('email');
            $menu->idcard 	        = $idcard ;
            $menu->npwp 	        = $npwp;
            $menu->berkas 	        = date("Y-m-d");
            $menu->berkas_lengkap 	= $berkas_lengkap;
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
            $menu->updated_by         = Auth::user()->name;  
            $menu->save(); 
            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('konsumen/data/'.$request->input('id_properti'));
             

        }

    }


    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');

            if(Auth::user()->id_jabatan <> 9)
            {   
                $data = Konsumen::select(DB::raw("nama,idcard,kode")) 
                        ->where("nama","LIKE","%{$request->input('query')}%")
                        ->where("iskonsumen","=",1)
                        ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                        ->orwhere("kode","LIKE","%{$request->input('query')}%")
                        ->get();
            }elseif(Auth::user()->id_jabatan == 9){
                $data = Konsumen::select(DB::raw("nama,idcard,kode"))
                ->where('id_marketing','=',Auth::user()->id)
                ->where("nama","LIKE","%{$request->input('query')}%")
                ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                ->orwhere("kode","LIKE","%{$request->input('query')}%")
                ->get();
            }


            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                    <li><a href="#">'.$row->kode.'-'.$row->nama.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    /*

    public function autocomplete(Request $request)
    {
        $data = Konsumen::select(DB::raw("nama,idcard,kode"))
                ->where("nama","LIKE","%{$request->input('query')}%")
                ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                ->orwhere("kode","LIKE","%{$request->input('query')}%")
                ->get();
 
        return response()->json($data);

    }
    */

   
 
}
