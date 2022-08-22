<?php

namespace App\Modules\Suratkonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Suratkonsumen\Models\Suratkonsumen;
use App\Modules\Konsumen\Models\Konsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class SuratkonsumenController extends Controller
{
	  /**
   * Display a listing of the resource.
   *
   * @param Docproperti $data
   */

  public function __construct(Suratkonsumen $data)
  {
      $this->data = $data;
  }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
		 $data = Suratkonsumen::select(db::raw("surat_konsumen.*,properti.nama as nama_properti,
									properti_kav.nama as nama_kav,
									konsumen.nama as nama_konsumen"))
								->leftjoin("konsumen","surat_konsumen.id_konsumen","=","konsumen.id")
								->leftjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
								->leftjoin("properti","konsumen.id_properti","=","properti.id")
								->leftjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
								->orderBy("surat_konsumen.tanggal","desc")->get();
        return view('Suratkonsumen::index',['data'=> $data]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {	
		$konsumen = Konsumen::select(db::raw("konsumen.*, properti.nama as nama_properti"))
					->leftjoin("properti","konsumen.id_properti","=","properti.id")
					->OrderBy("konsumen.id","ASC")->get();
        return view('Suratkonsumen::create',['konsumen' => $konsumen]);
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

            return Redirect::to('suratkonsumen/create')->withErrors($validator)->withInput();

        } else {

            $data = new Suratkonsumen;
            $data->kode = $request->input("kode"); 
            $data->tanggal = $request->input("tanggal");
            $data->id_konsumen =$request->input("id_konsumen");
			$data->pengirim = Auth::user()->name;
            $data->perihal = $request->input("perihal"); 
            
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
            return redirect('suratkonsumen');


        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('Suratkonsumen::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
		$data = Suratkonsumen::findOrfail($id);
		$konsumen = Konsumen::select(db::raw("konsumen.*, properti.nama as nama_properti"))
					->leftjoin("properti","konsumen.id_properti","=","properti.id")
					->OrderBy("konsumen.id","ASC")->get();
        return view('Suratkonsumen::edit',['konsumen' => $konsumen ])->with('data', $data) ;
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
            
            return Redirect::to('suratkonsumen/'.$id.'/edit')->withErrors($validator)->withInput();

        } else {

            
            $data = Suratkonsumen::findOrFail($id);
             $data->kode = $request->input("kode"); 
            $data->tanggal = $request->input("tanggal");
            $data->id_konsumen =$request->input("id_konsumen");
            $data->perihal = $request->input("perihal");
			$data->pengirim = Auth::user()->name;
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

            return redirect('suratkonsumen');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $users = Suratkonsumen::findOrFail($id);
        $users->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');

        return redirect('suratkonsumen');
    }
}
