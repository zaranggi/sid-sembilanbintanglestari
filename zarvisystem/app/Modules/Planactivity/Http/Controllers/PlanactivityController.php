<?php

namespace App\Modules\Planactivity\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Planactivity\Models\Planactivity;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanactivityController extends Controller
{
      /**
   * Display a listing of the resource.
   *
   * @param Notulen $data
   */

    public function __construct(Planactivity $data)
    {
      $this->data = $data;
    }
  /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(Auth::user()->id_jabatan ==9){
            $data = Planactivity::select(db::raw("marketing_plan.*,users.name"))
                        ->leftjoin("users","marketing_plan.id_marketing","=","users.id")
                        ->where("marketing_plan.id_marketing","=",Auth::user()->id)
                        ->orderBy("id","desc")->get();
        }else{
            $data = Planactivity::select(db::raw("marketing_plan.*,users.name"))
                        ->leftjoin("users","marketing_plan.id_marketing","=","users.id")
                        ->orderBy("id","desc")->get();
        }
        

        return view('Planactivity::index',['data' => $data]);
    }
 

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Planactivity::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'tanggal_start'           => 'required', 
            'tanggal_end'            => 'required', 
            'plan'                   => 'required', 
        ); 

        $validator = Validator::make($request->all(), $rules); 

        if ($validator->fails()) {

            return Redirect::to('planactivity/create')->withErrors($validator)->withInput();

        } else {

            $data = new Planactivity; 
            $data->id_marketing = Auth::user()->id;
            $data->tanggal_start = $request->input("tanggal_start"); 
            $data->tanggal_end = $request->input("tanggal_end"); 
            $data->plan = $request->input("plan");  
            $data->save(); 
            Session::flash('flash_message', 'Data has been successful Added!');
            return redirect('planactivity');


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('Planactivity::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Planactivity::findOrfail($id);

        return view('Planactivity::edit')->with('data', $data) ; 
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
            'tanggal_start'           => 'required', 
            'tanggal_end'            => 'required', 
            'plan'                   => 'required', 
        ); 

    
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            
            return Redirect::to('planactivity/'.$id.'/edit')->withErrors($validator)->withInput();

        } else {

            
            $data = Planactivity::findOrFail($id);
            $data->id_marketing = Auth::user()->id;
            $data->tanggal_start = $request->input("tanggal_start"); 
            $data->tanggal_end = $request->input("tanggal_end"); 
            $data->plan = $request->input("plan"); 
            $data->ach = $request->input("ach"); 
            $data->save(); 

            $request->session()->flash('flash_message', 'Data Berhasil diupdate!');

            return redirect('planactivity');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = Planactivity::findOrFail($id);
        $users->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');

        return redirect('planactivity');
    }
}
