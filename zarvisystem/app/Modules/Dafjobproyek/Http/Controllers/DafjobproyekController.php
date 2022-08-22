<?php

namespace App\Modules\Dafjobproyek\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Dafjobproyek\Models\Dafjobproyek;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class DafjobproyekController extends Controller
{
	
    /**
   * Display a listing of the resource.
   *
   * @param Dafjobproyek $data
   */

  public function __construct(Dafjobproyek $data)
  {
      $this->data = $data;
  }
    /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
      $data = Dafjobproyek::All();
      return view('Dafjobproyek::index', ['data' => $data]);

  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
      
      $data = Dafjobproyek::All();
      return view('Dafjobproyek::create', ['listprogress' => $data]); 

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
      );

      $validator = Validator::make($request->all(), $rules);
      if ($validator->fails()) {
          return Redirect::to('dafjobproyek/create')->withErrors($validator)->withInput();
      }
      else
      {
          $data = new Dafjobproyek;
          $data->nama 	        = $request->input('nama'); 
         // $data->bobot 	        = $request->input('bobot'); 
          //$data->id_main 	        = $request->input('id_main'); 
          $data->save();

          Session::flash('flash_message', 'Data has been successful Added!');
          return redirect('dafjobproyek');

      }
  }
 

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
      $data = Dafjobproyek::findOrFail($id); 
      return view("dafjobproyek::edit")->with('data', $data); 
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
      );

      $validator =Validator::make($request->all(), $rules);

      if ($validator->fails()) {
          return Redirect::to('dafjobproyek/'.$id.'/edit')->withErrors($validator)->withInput();
      }
      else
      {
          
          $data = Dafjobproyek::findOrFail($id); 
          $data->nama 	        = $request->input('nama');  
        //  $data->bobot 	        = $request->input('bobot'); 
         // $data->id_main 	        = $request->input('id_main'); 
          $data->save();

          //	echo $auth_access;

          Session::flash('flash_message', 'Data has been successful Edited!');
          return redirect('dafjobproyek');

      }
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
      $menu = Dafjobproyek::findOrFail($id);
      $menu->delete();
      Session::flash('flash_message', 'Data has been successful Deleted!');
      return redirect('dafjobproyek');
  }

}
