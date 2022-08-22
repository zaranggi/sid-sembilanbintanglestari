<?php

namespace App\Modules\Setprogproperti\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Setprogproperti\Models\Setprogproperti;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SetprogpropertiController extends Controller
{/**
   * Display a listing of the resource.
   *
   * @param Docproperti $data
   */

  public function __construct(Setprogproperti $data)
  {
      $this->data = $data;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
      $data = $this->data->listall();
      return view('Setprogproperti::index', ['data' => $data]);

  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
      
      $data = Setprogproperti::All();
      return view('Setprogproperti::create', ['listprogress' => $data]); 

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
          return Redirect::to('setprogproperti/create')->withErrors($validator)->withInput();
      }
      else
      {
          $data = new Setprogproperti;
          $data->nama 	        = $request->input('nama'); 
         // $data->bobot 	        = $request->input('bobot'); 
          //$data->id_main 	        = $request->input('id_main'); 
          $data->save();

          Session::flash('flash_message', 'Data has been successful Added!');
          return redirect('setprogproperti');

      }
  }

  /**
   * Show the specified resource.
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
      return view('Setprogproperti::show');
  }

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
      $data = Setprogproperti::findOrFail($id); 
        $listprogress = Setprogproperti::All();
      return view("setprogproperti::edit", ['listprogress' => $listprogress])->with('data', $data); 
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
          return Redirect::to('setprogproperti/'.$id.'/edit')->withErrors($validator)->withInput();
      }
      else
      {
          
          $data = Setprogproperti::findOrFail($id); 
          $data->nama 	        = $request->input('nama');  
        //  $data->bobot 	        = $request->input('bobot'); 
         // $data->id_main 	        = $request->input('id_main'); 
          $data->save();

          //	echo $auth_access;

          Session::flash('flash_message', 'Data has been successful Edited!');
          return redirect('setprogproperti');

      }
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
      $menu = Setprogproperti::findOrFail($id);
      $menu->delete();
      Session::flash('flash_message', 'Data has been successful Deleted!');
      return redirect('setprogproperti');
  }
}
