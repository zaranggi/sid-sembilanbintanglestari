<?php

namespace App\Modules\Surat\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Surat\Models\Surat;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
     /**
   * Display a listing of the resource.
   *
   * @param Docproperti $data
   */

  public function __construct(Surat $data)
  {
      $this->data = $data;
  }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = Surat::where("jenis","=","in")->orderBy("tanggal","desc")->get();
        return view('Surat::index',['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('Surat::create');
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

            return Redirect::to('surat/create')->withErrors($validator)->withInput();

        } else {

            $data = new Surat;
            $data->kode = $request->input("kode");
            $data->jenis = "in";
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
            return redirect('surat');


        }

    }

   
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = Surat::findOrfail($id);

        return view('Surat::edit')->with('data', $data) ;
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
            
            return Redirect::to('surat/'.$id.'/edit')->withErrors($validator)->withInput();

        } else {

            
            $data = Surat::findOrFail($id);
            $data->kode = $request->input("kode");
            $data->jenis = "in";
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

            return redirect('surat');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = Surat::findOrFail($id);
        $users->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');

        return redirect('surat');
    }
}
