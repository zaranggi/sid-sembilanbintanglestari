<?php

namespace App\Modules\Progrevisi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Progrevisi\Models\progrevisi;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Modules\Spk\Models\Progresbangun;
use DB;
class ProgrevisiController extends Controller
{
    public function __construct(Progrevisi $data)
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
        return view('Progrevisi::index', ['data' => $data]);
    }

     
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {
		
		$data = $this->data->spk($id);
		 
		 
		return view("progrevisi::edit",['data' => $data ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function simpan(Request  $request)
    {  
        $rules = array(
            'id' => 'required|numeric',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('progrevisi/'.$request->input("id").'/edit')->withErrors($validator)->withInput();
        }
        else
        {
			
			$data = Progrevisi::findOrFail($request->input("id")); 
			
            $namafile1 = ""; 
            if ($request->hasFile('photo1')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }                
                $file = $request->file('photo1');    
                $namafile1 = uniqid() . '_' . trim($file->getClientOriginalName());    
                $file->move($path, $namafile1);
				
				$data->photo1 		= $namafile1;
                 
            }
            $namafile2 = ""; 
            if ($request->hasFile('photo2')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }                
                $file = $request->file('photo2');    
                $namafile2 = uniqid() . '_' . trim($file->getClientOriginalName());    
                $file->move($path, $namafile2); 
				
				$data->photo2 		= $namafile2;
            }
            $namafile3 = ""; 
            if ($request->hasFile('photo3')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }                
                $file = $request->file('photo3');    
                $namafile3 = uniqid() . '_' . trim($file->getClientOriginalName());    
                $file->move($path, $namafile3); 
				
				$data->photo3 		= $namafile3;
            }
            
            
            $data->status 		= $request->input('status');
            $data->save();
            

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('progrevisi/'.$request->input("id").'/edit');

        }
    }
 
}
