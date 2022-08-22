<?php

namespace App\Modules\Munit\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
 
use App\Modules\Munit\Models\Munit;
use App\Modules\Munit\Models\Kavimg;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;

class MunitController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Munit $data
     */

    public function __construct(Munit $data)
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
        
        return view("Munit::index", ['data' => $data]);
 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function unit($id)
    {
        $data = $this->data->listunit($id);      
        $data_prop = $this->data->data_properti($id);   

        return view("Munit::unit", 
                            [
                                'data' => $data,
                                'data_prop' => $data_prop
                                    
                            ]);
 
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function tambah($id)
    { 

        return view("Munit::tambah", 
                            [
                                'id_properti' => $id,
                                //'data_prop' => $data_prop
                                    
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
            'nama' => 'required|max:20',
            'tipe' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            
            return Redirect::to('munit/tambah/'.$request->input('id_properti'))->withErrors($validator)->withInput();
        }
        else
        {
            
            
            $luas_tanah = str_replace(",","",$request->input('luas_tanah'));
            $luas_bangunan = str_replace(",","",$request->input('luas_bangunan'));
            $harga = str_replace(",","",$request->input('harga'));
            $hargakav = str_replace(",","",$request->input('hargakav'));
            $hpp_tanah = str_replace(",","",$request->input('hpp_tanah'));
            $hpp_bangunan = str_replace(",","",$request->input('hpp_bangunan'));
            
            $menu = new Munit; 
            $menu->nama         	= $request->input('nama');
            $menu->id_properti      = $request->input('id_properti');
            $menu->keterangan 	    = $request->input('keterangan');
            $menu->tipe          	= $request->input('tipe'); 
            $menu->luas_tanah 		= $luas_tanah; 
            $menu->luas_bangunan	= $luas_bangunan; 
            $menu->harga 	    	= $harga; 
            $menu->hargakav 		= $hargakav;
            $menu->hpp_tanah 		= $hpp_tanah;
            $menu->hpp_bangunan		= $hpp_bangunan;  
            $menu->save(); 
            
            $t = count($request->input('document', []));
            if($t > 0){
                
                foreach ($request->input('document', []) as $file) {

                    $img = new Kavimg; 
                    $img->id_kav      = $menu->id;
                    $img->gambar 	  = $file; 
                    $img->save(); 

                }
            }

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('munit/unit/'.$request->input('id_properti'));
             

        }
    }
 

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Munit::findOrFail($id);
        
        $gambar = $this->data->gambar($id);

        return view("Munit::edit", [
                'gambar' => $gambar
        ])->with('data', $data);
 
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
            'nama' => 'required|max:20',
            'tipe' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            
            return Redirect::to('munit/'.$id.'/edit')->withErrors($validator)->withInput(); 
        }
        else
        { 

            $luas_tanah = str_replace(",","",$request->input('luas_tanah'));
            $luas_bangunan = str_replace(",","",$request->input('luas_bangunan'));
            $harga = str_replace(",","",$request->input('harga'));
            $hargakav = str_replace(",","",$request->input('hargakav'));
            $hpp_tanah = str_replace(",","",$request->input('hpp_tanah'));
            $hpp_bangunan = str_replace(",","",$request->input('hpp_bangunan'));
            
            $menu = Munit::findOrFail($id);
            $menu->nama         	= $request->input('nama'); 
            $menu->keterangan 	    = $request->input('keterangan');
            $menu->tipe          	= $request->input('tipe'); 
            $menu->luas_tanah 		= $luas_tanah; 
            $menu->luas_bangunan	= $luas_bangunan; 
            $menu->harga 	    	= $harga; 
            $menu->hargakav 		= $hargakav;  
            $menu->hpp_tanah 		= $hpp_tanah;
            $menu->hpp_bangunan		= $hpp_bangunan;  
            $menu->save(); 
            
            $t = count($request->input('document', []));
            if($t > 0){
                
                foreach ($request->input('document', []) as $file) {
                    $img = new Kavimg; 
                    $img->id_kav      = $menu->id;
                    $img->gambar 	  = $file; 
                    $img->save();
                }
            }

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('munit/unit/'.$menu->id_properti);

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Munit::findOrFail($id);
        $menu->status = 2; 
        $menu->save(); 

         DB::table('properti_img')->where('id_properti', '=', $id)->delete(); 

         Session::flash('flash_message', 'Data has been Deleted!');
         return redirect('munit/unit/'.$menu->id_properti);
    }

    public function simpangambar(Request $request)
    {
        $path ='image/unit';

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
}
