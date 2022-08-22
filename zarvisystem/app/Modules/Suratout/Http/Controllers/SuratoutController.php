<?php

namespace App\Modules\Suratout\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use App\Modules\Suratout\Models\Suratout;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SuratoutController extends Controller
{
     /**
   * Display a listing of the resource.
   *
   * @param Docproperti $data
   */

  public function __construct(Suratout $data)
  {
      $this->data = $data;
  }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Suratout::where("jenis","=","out")->orderBy("tanggal","desc")->get();
        return view('Suratout::index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Suratout::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'kode'           => 'required', 
        ); 

        $validator = Validator::make($request->all(), $rules); 

        if ($validator->fails()) {

            return Redirect::to('suratout/create')->withErrors($validator)->withInput();

        } else {

            $data = new Suratout;
            $data->kode = $request->input("kode");
            $data->jenis = "out";
            $data->tanggal = $request->input("tanggal");
            $data->pengirim =$request->input("pengirim");
            $data->perihal = $request->input("perihal");
            //$data->isi = $request->input("isi");
            
            $path ='image/surat';

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
            return redirect('suratout');


        }

    }

   
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Suratout::findOrfail($id);

        return view('Suratout::edit')->with('data', $data) ;
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

                'kode' => 'required',

            );

        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            
            return Redirect::to('suratout/'.$id.'/edit')->withErrors($validator)->withInput();

        } else {

            
            $data = Suratout::findOrFail($id);
            $data->kode = $request->input("kode");
            $data->jenis = "out";
            $data->tanggal = $request->input("tanggal");
            $data->pengirim =$request->input("pengirim");
            $data->perihal = $request->input("perihal");
            //$data->isi = $request->input("isi");
            
            $path ='image/surat';

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

            return redirect('suratout');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = Suratout::findOrFail($id);
        $users->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');

        return redirect('suratout');
    }
}
