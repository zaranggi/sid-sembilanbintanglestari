<?php

namespace App\Modules\Setprogkonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Setprogkonsumen\Models\Setprogkonsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SetprogkonsumenController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @param Docproperti $data
   */

  public function __construct(Setprogkonsumen $data)
  {
      $this->data = $data;
  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
      $data = Setprogkonsumen::All();
      return view('Setprogkonsumen::index', ['data' => $data]);

  }

  /**
   * Show the form for creating a new resource.
   * @return Response
   */
  public function create()
  {
      
      return view('Setprogkonsumen::create'); 

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
          return Redirect::to('setprogkonsumen/create')->withErrors($validator)->withInput();
      }
      else
      {
          $data = new Setprogkonsumen;
          $data->nama 	        = $request->input('nama'); 
          $data->save();

          Session::flash('flash_message', 'Data has been successful Added!');
          return redirect('setprogkonsumen');

      }
  }

  /**
   * Show the specified resource.
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
      return view('docproperti::show');
  }

  /**
   * Show the form for editing the specified resource.
   * @param int $id
   * @return Response
   */
  public function edit($id)
  {
      $data = Setprogkonsumen::findOrFail($id); 

      return view("setprogkonsumen::edit")->with('data', $data); 
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
          return Redirect::to('dockonsumen/'.$id.'/edit')->withErrors($validator)->withInput();
      }
      else
      {
          
          $data = Setprogkonsumen::findOrFail($id); 
          $data->nama 	        = $request->input('nama');  
          $data->save();

          //	echo $auth_access;

          Session::flash('flash_message', 'Data has been successful Edited!');
          return redirect('setprogkonsumen');

      }
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id
   * @return Response
   */
  public function destroy($id)
  {
      $menu = Setprogkonsumen::findOrFail($id);
      $menu->delete();
      Session::flash('flash_message', 'Data has been successful Deleted!');
      return redirect('setprogkonsumen');
  }
}
