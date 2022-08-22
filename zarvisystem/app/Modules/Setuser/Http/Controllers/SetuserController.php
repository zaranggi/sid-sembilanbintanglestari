<?php

namespace App\Modules\Setuser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Setuser\Models\Setuser;

use App\Modules\Users\Models\Users;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB;
class SetuserController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @param Setuser $data
     */

    public function __construct(Setuser $data)
    {
        $this->data = $data;
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		$listusers = Users::select(db::raw("users.*, jabatan.name_jabatan"))
			->leftjoin("jabatan","users.id_jabatan","=","jabatan.id_jabatan")->get();
			
        $properti =  $this->data->properti();
        
        return view("Setuser::index", ['listusers' => $listusers]); 
    }

    public function edit($id)
    {
        $data = Users::findOrFail($id);
		
        $properti =  $this->data->properti();
        $akses =  $this->data->akses($id);
		$c = array();
		foreach($akses as $r){
			array_push($c,"#".$r->id_properti."#"); 
		}
		 
		 
        return view("Setuser::create", [
            'properti' => $properti,
			'c' => $c
           ])->with('data', $data);
		   
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update($id, Request  $request)
    { 
			$akses = $request->input("akses");
          if(count($request->input("akses")) > 0){
			  
			DB::table('properti_marketing')->where('id_users', '=', $id)->delete(); 
			
			foreach($akses as $x){				
				$data = new Setuser;
				$data->id_properti 	= $x ;
				$data->id_users 	= $id ;
				$data->save();
			}
			
		  }else{
			  DB::table('properti_marketing')->where('id_users', '=', $id)->delete();
			
		  }
            
            $request->session()->flash('flash_message', 'Data has ben successful Edited!');

            return redirect('setuser');
        
    }

}
