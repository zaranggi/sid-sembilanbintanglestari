<?php

namespace App\Modules\Mrabnew\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Mrabnew\Models\Mrabnew;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MrabnewController extends Controller
{
    /* Display a listing of the resource.
    *
    * @param Mrabnew $data
    */

   public function __construct(Mrabnew $data)
   {
       $this->data = $data;
   }

   /**
    * Display a listing of the resource.
    * @return Response
    */
   public function index()
   {
       $data = $this->data->dataall();

       return view('Mrabnew::index', ['data' =>$data ]);

   }

    /**
    * Display a listing of the resource.
    * @return Response
    */

    public function data(Request $request, $id)
    {

        $properti = $this->data->namaproperti($id);
        $data = Mrabnew::where("id_properti","=",$id)
                ->OrderBy("id","DESC")->get();

        return view('Mrabnew::data', ['data' =>$data,
									'properti' => $properti,
									'id_properti' => $id
								]);

    }


   public function view($id)
   {

       $data = Mrabnew::findOrFail($id);


       return view('Mrabnew::view', [
                                   'id' => $id
                               ])->with('data', $data);

   }


   public function ubah($id)
   {

       $data = Mrabnew::findOrFail($id);

       return view('Mrabnew::ubah')->with('data', $data);

   }

   public function ubahsimpan(Request $request)
   {
       $rules = array(
		   'judul' => 'required',
		   'hari' => 'required|numeric',
		   'gross' => 'required',
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {

           return Redirect::to('Mrabnew/ubah/'.$request->input('id'))->withErrors($validator)->withInput();
       }
       else
       {
		    $data = Mrabnew::findOrFail($request->input('id'));
		    $data->judul 		= $request->input('judul');
		    $data->hari 		= $request->input('hari');
		    $data->satuan 		= $request->input('satuan');
		    $data->qty 			=  str_replace(",","",$request->input('qty'));
		    $data->bobot  		= 100;
		    $data->kategori 	= 'Pembangunan';
		    $data->jenis 	 	= 'Borongan';
		    $data->gross 		= str_replace(",","",$request->input('gross'));
		    $data->t1 			= $request->input('t1');
		    $data->t2 			= $request->input('t2');
		    $data->t3 			= $request->input('t3');
		    $data->t4 			= $request->input('t4');
		    $data->t5 			= $request->input('t5');
		    $data->retensi 		= $request->input('retensi');
		    $data->created_by	= Auth::user()->name;
		    $data->created_date = date("Y-m-d");
		    $data->save();

           Session::flash('flash_message', 'Data has ben successful Edited!');
		   return Redirect::to('mrabnew/data/'.$data->id_properti);

       }

   }


   /**
    * Show the form for creating a new resource.
    * @return Response
    */
   public function add(Request $request, $id)
   {

       return view('Mrabnew::create',['id_properti' => $id]);
   }

   /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return Response
    */
   public function store(Request $request)
   {
       $rules = array(
           'id_properti' => 'required|numeric',
		   'judul' => 'required',
		   'hari' => 'required|numeric',
		   'gross' => 'required',
       );

       $validator =Validator::make($request->all(), $rules);

       if ($validator->fails()) {

           return Redirect::to('mrabnew/add/'.$request->input('id_properti'))->withErrors($validator)->withInput();
       }
       else
       {

               $data = new Mrabnew;
               $data->id_properti 	= $request->input('id_properti');
               $data->judul 	= $request->input('judul');
               $data->hari 	= $request->input('hari');
               $data->satuan 	= $request->input('satuan');
               $data->qty 	=  str_replace(",","",$request->input('qty'));
               $data->bobot  		= 100;
               $data->kategori 		= 'Pembangunan';
               $data->jenis 	 	= 'Borongan';
               $data->gross 		= str_replace(",","",$request->input('gross'));
               $data->t1 			= $request->input('t1');
               $data->t2 			= $request->input('t2');
               $data->t3 			= $request->input('t3');
               $data->t4 			= $request->input('t4');
               $data->t5 			= $request->input('t5');
               $data->retensi 		= $request->input('retensi');
               $data->created_by	= Auth::user()->name;
               $data->created_date = date("Y-m-d");
               $data->save();


           Session::flash('flash_message', 'Data has ben successful Added!');
          return Redirect::to('mrabnew/data/'.$request->input('id_properti'));

       }

   }

   public function ajukan($id_properti,$id)
   {
       $this->data->ajukan($id);
       $pesan = "Anda memiliki Pending Approval atas Pengajuan RAB Baru Oleh:". Auth::user()->name;
       $this->data->insertwa($pesan);

       Session::flash('flash_message', 'RAB Berhasil diajukan.');
       return redirect('mrabnew/data/'.$id_properti);

   }


}
