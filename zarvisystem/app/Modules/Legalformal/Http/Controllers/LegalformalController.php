<?php

namespace App\Modules\Legalformal\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 

use App\Modules\Legalformal\Models\Legalformal;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;
class LegalformalController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Legalformal $data
     */

    public function __construct(Legalformal $data)
    {
        $this->data = $data;
    }
     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->dataproperti();
        
        return view("Legalformal::index", ['data' => $data]);
 
    }
    public function datalegalitas($id)
    {
        $data = $this->data->datalegalitas($id);
        
        return view("Legalformal::datalegalitas", 
        [
            'data' => $data,
            'id_properti' => $id
                
        ]);
 
    }
    public function addnew($id)
    {  
        $jenis_legalformal = $this->data->jenis_legalformal();
        $properti_kav = $this->data->properti_kav($id);
        
        return view("Legalformal::create", 
        [
            'jenis_legalformal' => $jenis_legalformal,
            'properti_kav' => $properti_kav,
            'id_properti' => $id
                
        ]);
 
    }
    
    /**
     *
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'id_properti' => 'required|max:255',
            'nama' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('addnew/'.$request->input('id_properti'))->withErrors($validator)->withInput();
        }
        else
        {

            $path ='image/legalformal';
                $file_name = "";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                if ($request->hasFile('namafile')) {
                    $file = $request->file('namafile');
     
                    $file_name = uniqid() . '_' . $request->input('id_properti').$request->input('nama');

                    $file->move($path, $file_name); 
                }

            
            $data = new Legalformal;
            $data->id_properti 	= $request->input('id_properti');
            $data->id_kav 		= $request->input('id_kav','');
            $data->kategori 	= $request->input('kategori');
            $data->nama 	    = $request->input('nama');
            $data->id_jenis 	= $request->input('id_jenis');
            $data->tgl_terbit 	= $request->input('tgl_terbit');
            $data->tgl_exp 	    = $request->input('tgl_exp');
            $data->nama 	    = $request->input('nama');
            $data->namafile 	= $file_name;
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('legalformal/data/'.$request->input('id_properti'));

        }
    } 

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function editlegal($id)
    {
        $data = Legalformal::findOrFail($id);

        $jenis_legalformal = $this->data->jenis_legalformal();
        $properti_kav = $this->data->properti_kav($data->id_properti);
        
        
        return view("Legalformal::edit", [ 
                                            'jenis_legalformal' => $jenis_legalformal ,
                                            'properti_kav' => $properti_kav,
                                            'id_properti' => $data->id_properti
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
            'id_properti' => 'required|max:255',
            'nama' => 'required'
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            return Redirect::to('legalformal/editlegal/'.$id)->withErrors($validator)->withInput();  
        }
        else
        {
              
            $path ='image/legalformal';
                $file_name = "";

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                
                if ($request->hasFile('namafile')) {
                    $file = $request->file('namafile');
     
                    $file_name = uniqid() . '_' . $request->input('id_properti').$request->input('nama');

                    $file->move($path, $file_name); 
                }


            $data = Legalformal::findOrFail($id);
            $data->id_properti 	= $request->input('id_properti');
            $data->id_kav 		= $request->input('id_kav','');
            $data->kategori 	= $request->input('kategori');
            $data->nama 	    = $request->input('nama');
            $data->id_jenis 	= $request->input('id_jenis');
            $data->tgl_terbit 	= $request->input('tgl_terbit');
            $data->tgl_exp 	    = $request->input('tgl_exp');
            $data->nama 	    = $request->input('nama');
            if($file_name != ""){
                $data->namafile 	= $file_name;
            }
            
            $data->save(); 
            Session::flash('flash_message', 'Data has ben successful Edited!');
            
            return redirect('legalformal/data/'.$request->input('id_properti'));
             

        }

    }

    public function destroy($id)
    {
        $menu = Legalformal::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('legalformal');
    }
   
}
