<?php

namespace App\Modules\Material\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Material\Models\Material; 
use App\Modules\Material\Models\Stmast; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Material $data
     */

    public function __construct(Material $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->data();
        return view('Material::index',["data" => $data ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = $this->data->vendor();
        return view('Material::create',["data" => $data ]); 
    }

    public function store(Request $request)
    {
        $rules = array( 
            'nama' => 'required',
            'satuan' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('material/create')->withErrors($validator)->withInput();
        }
        else
        {
            $price = str_replace(",","",$request->input('price'));
            $tempo = str_replace(",","",$request->input('tempo'));
            $begbal = str_replace(" ","",$request->input('begbal'));
            //$pkm = str_replace(" ","",$request->input('pkm'));
            //$minor = str_replace(" ","",$request->input('minor'));
            
            $noUrutAkhir = Material::max('prdcd');
			if($noUrutAkhir ==""){
				$prdcd = "1".sprintf("%06s", $noUrutAkhir + 1);	
			}else{
				$prdcd = $noUrutAkhir + 1;	
			}
            

            $data = new Material;
            $data->prdcd 	= $prdcd;
            $data->nama 		= $request->input('nama');
            $data->id_vendor	= $request->input('id_vendor');
           // $data->merk 		= $request->input('merk');
            $data->satuan 		= $request->input('satuan');
            $data->price 	= $price;
            $data->tempo 	= $tempo;
            $data->save();

            $data = new Stmast;
            $data->prdcd 	= $prdcd;
            $data->begbal 	= $begbal;
            //$data->pkm 		= $pkm;
            //$data->minor 	= $minor;
            $data->qty  	= $begbal;
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('material');

        }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {
        
        $data =  $this->data->data2($id); 
        $vendor = $this->data->vendor();
       
        return view("material::edit",['vendor' => $vendor])->with('data', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update($id, Request  $request)
    {
        $rules = array( 
            'nama' => 'required',
            'satuan' => 'required',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('material/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
             
            $price = str_replace(",","",$request->input('price'));
            $tempo = str_replace(",","",$request->input('tempo'));
            $begbal = str_replace(" ","",$request->input('begbal'));
            //$pkm = str_replace(" ","",$request->input('pkm'));
           // $minor = str_replace(" ","",$request->input('minor'));

            $data = Material::findOrFail($id);  
            $data->nama 		= $request->input('nama');
            $data->id_vendor	= $request->input('id_vendor');
            //$data->merk 		= $request->input('merk');
            $data->satuan 		= $request->input('satuan');
            $data->price    	= $price;
            $data->tempo 	= $tempo;
            $data->save();

            $data = Stmast::findOrFail($id); 
            $data->begbal 	= $begbal;
            //$data->pkm 		= $pkm;
            //$data->minor 	= $minor;
            $data->qty  	= $begbal;
            $data->save();
 

            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('material');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    { 
        $menu = Material::findOrFail($id);
        $menu->recid = 1;
        $menu->save();

        $menu = Stmast::findOrFail($id);
        $menu->recid = 1;
        $menu->save();

        Session::flash('flash_message', 'Data has been successful Deactive!');
        return redirect('material');
    }
}
