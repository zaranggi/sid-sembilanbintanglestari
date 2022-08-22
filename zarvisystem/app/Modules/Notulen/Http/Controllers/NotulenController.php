<?php

namespace App\Modules\Notulen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Notulen\Models\Notulen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NotulenController extends Controller
{
     /**
   * Display a listing of the resource.
   *
   * @param Notulen $data
   */

  public function __construct(Notulen $data)
  {
      $this->data = $data;
  }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Notulen::orderBy("tanggal","desc")->get();
        return view('Notulen::index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Notulen::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'tanggal'           => 'required', 
        ); 

        $validator = Validator::make($request->all(), $rules); 

        if ($validator->fails()) {

            return Redirect::to('notulen/create')->withErrors($validator)->withInput();

        } else {

            $data = new Notulen;
            //$data->kode = $request->input("kode"); 
            $data->tanggal = $request->input("tanggal"); 
            $data->perihal = $request->input("perihal");
           // $data->isi = $request->input("isi");
            
            $path ='image/notulen';

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if($request->hasFile('file')){
            
                $file = $request->file('file');

                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $file->move($path, $name);

                $data->file = $name;
            }

            $data->save(); 
            Session::flash('flash_message', 'Data has been successful Edited!');
            return redirect('notulen');


        }

    }

   
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Notulen::findOrfail($id);

        return view('Notulen::edit')->with('data', $data) ;
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

                'tanggal' => 'required',

            );

        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            
            return Redirect::to('notulen/'.$id.'/edit')->withErrors($validator)->withInput();

        } else {

            
            $data = Notulen::findOrFail($id);
            //$data->kode = $request->input("kode"); 
            $data->tanggal = $request->input("tanggal"); 
            $data->perihal = $request->input("perihal");
            //$data->isi = $request->input("isi");
            
            $path ='image/Notulen';

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if($request->hasFile('file')){
            
                $file = $request->file('file');

                $name = uniqid() . '_' . trim($file->getClientOriginalName());

                $file->move($path, $name);

                $data->file = $name;
            }

            $data->save(); 
            $request->session()->flash('flash_message', 'Data Berhasil diupdate!');

            return redirect('notulen');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = Notulen::findOrFail($id);
        $users->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');

        return redirect('notulen');
    }
}
