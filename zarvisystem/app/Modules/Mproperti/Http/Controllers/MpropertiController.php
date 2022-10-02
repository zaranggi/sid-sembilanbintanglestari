<?php

namespace App\Modules\Mproperti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Mproperti\Models\Mproperti;
use App\Modules\Mproperti\Models\Propertiimg;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\DB;

class MpropertiController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Mproperti $data
     */

    public function __construct(Mproperti $data)
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
        
        return view("Mproperti::index", ['data' => $data]);
 
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $bank = $this->data->bank();
        return view('Mproperti::create', ['bank' => $bank]);

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
            'alamat' => 'required',
            'alamatkantor' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
            
            return Redirect::to('mproperti/create')->withErrors($validator)->withInput();
        }
        else
        {
           

            is_array($request->input('bank')) ? $bank = implode(" ",$request->input('bank')) : $bank ="";
            
            $luas_tanah = str_replace(",","",$request->input('luas_tanah'));
            
            $menu = new Mproperti; 
            $menu->nama         	= $request->input('nama');
            $menu->alamat 	    	= $request->input('alamat');
            $menu->alamatkantor 	= $request->input('alamatkantor'); 
            $menu->luas_tanah 		= $luas_tanah; 
            $menu->bank      		= $bank; 
            $menu->save(); 
            
            $t = count($request->input('document', []));
            if($t > 0){
                
                foreach ($request->input('document', []) as $file) {

                    $img = new Propertiimg; 
                    $img->id_properti      = $menu->id;
                    $img->gambar 	       = $file; 
                    $img->save(); 

                }
            }

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('mproperti');
             

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('mproperti::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Mproperti::findOrFail($id);

        $data_bank = $this->data->bank();
        $gambar = $this->data->gambar($id);
 

        return view("Mproperti::edit", ['data_bank' => $data_bank,
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
            'nama' => 'required|max:255',
            'alamat' => 'required',
            'alamatkantor' => 'required', 

        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) { 
           return Redirect::to('mproperti/'.$id.'/edit')->withErrors($validator)->withInput(); 
        }
        else
        {
             
            is_array($request->input('bank')) ? $bank = implode(" ",$request->input('bank')) : $bank ="";
            $luas_tanah = str_replace(",","",$request->input('luas_tanah'));

            $menu                   = Mproperti::findOrFail($id); 
            $menu->nama         	= $request->input('nama');
            $menu->alamat 	    	= $request->input('alamat');
            $menu->alamatkantor 	= $request->input('alamatkantor'); 
            $menu->luas_tanah 		= $luas_tanah; 

            /** @var TYPE_NAME $menu  */
            $menu->save();
            //	echo $auth_access;
            
            $t = count($request->input('document', [])); 

            if($t > 0){
                
                DB::table('properti_img')->where('id_properti', '=', $id)->delete(); 

                foreach ($request->input('document', []) as $file) {
                    
                    $img = new Propertiimg; 
                    $img->id_properti      = $menu->id;
                    $img->gambar 	       = $file; 
                    $img->save(); 

                }

            }
            
            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('mproperti');

        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
         $menu = Mproperti::findOrFail($id);
         $menu->delete(); 

         DB::table('properti_img')->where('id_properti', '=', $id)->delete(); 

         Session::flash('flash_message', 'Data has been Deleted!');
         return redirect('mproperti');
                
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'),$imageName);  

        return response()->json(['success'=>$imageName]);

    }

    public function simpangambar(Request $request)
    {
        $path ='image/properti';

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
