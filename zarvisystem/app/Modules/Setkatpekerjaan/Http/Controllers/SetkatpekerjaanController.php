<?php

namespace App\Modules\Setkatpekerjaan\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Setkatpekerjaan\Models\Setkatpekerjaan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SetkatpekerjaanController extends Controller
{

    /**
   * Display a listing of the resource.
   *
   * @param Setkatpekerjaan $data
   */

  public function __construct(Setkatpekerjaan $data)
  {
      $this->data = $data;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
      $data = Setkatpekerjaan::All();
      return view('Setkatpekerjaan::index', ['data' => $data]);

  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
      
      $data = Setkatpekerjaan::All();
      return view('Setkatpekerjaan::create', ['listprogress' => $data]); 

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
          return Redirect::to('setkatpekerjaan/create')->withErrors($validator)->withInput();
      }
      else
      {
          $data = new Setkatpekerjaan;
          $data->nama 	        = $request->input('nama'); 
         // $data->bobot 	        = $request->input('bobot'); 
          //$data->id_main 	        = $request->input('id_main'); 
          $data->save();

          Session::flash('flash_message', 'Data has been successful Added!');
          return redirect('setkatpekerjaan');

      }
  }
 

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
      $data = Setkatpekerjaan::findOrFail($id); 
      return view("setkatpekerjaan::edit")->with('data', $data); 
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
          return Redirect::to('setkatpekerjaan/'.$id.'/edit')->withErrors($validator)->withInput();
      }
      else
      {
          
          $data = Setkatpekerjaan::findOrFail($id); 
          $data->nama 	        = $request->input('nama');  
        //  $data->bobot 	        = $request->input('bobot'); 
         // $data->id_main 	        = $request->input('id_main'); 
          $data->save();

          //	echo $auth_access;

          Session::flash('flash_message', 'Data has been successful Edited!');
          return redirect('setkatpekerjaan');

      }
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
      $menu = Setkatpekerjaan::findOrFail($id);
      $menu->delete();
      Session::flash('flash_message', 'Data has been successful Deleted!');
      return redirect('setkatpekerjaan');
  }

   
}
