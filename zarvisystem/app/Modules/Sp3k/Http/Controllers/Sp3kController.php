<?php

namespace App\Modules\Sp3k\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Sp3k\Models\Sp3k; 
use App\Modules\Konsumen\Models\Konsumen; 
use App\Modules\Trxkonsumen\Models\Trxkonsumen; 
use App\Modules\Trxkonsumen\Models\Konsumenlog;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;

class Sp3kController extends Controller
{
    /**
  * Display a listing of the resource.
  *
  * @param Docproperti $data
  */

 public function __construct(Sp3k $data)
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
       return view('Sp3k::index',['data' => $data]);
   }

   /**
    * Show the form for creating a new resource.
    * @return Response
    */
   public function create()
   {
       $bank = $this->data->listbank();
       return view('Sp3k::create',['bank' => $bank]);
   }

   /**
    * Store a newly created resource in storage.
    * @param Request $request
    * @return Response
    */
   public function store(Request $request)
   {
       $rules = array(
           'id_spr'           => 'required', 
       ); 

       $validator = Validator::make($request->all(), $rules); 

       if ($validator->fails()) {

           return Redirect::to('sp3k/create')->withErrors($validator)->withInput();

       } else {

           $data = new Sp3k;
           $data->id_spr = $request->input("id_spr");
           $data->bank = $request->input("bank");
           $data->tanggal_sp3k = $request->input("tanggal_sp3k"); 
           $data->nominal_acc = str_replace(",","",$request->input("nominal_acc"));
           $data->jangka_waktu = str_replace(" ","",$request->input("jangka_waktu"));
           $data->angsuran = str_replace(",","",$request->input("angsuran"));
           $data->biaya = str_replace(",","",$request->input("biaya"));
           $data->jenis_kredit =$request->input("jenis_kredit"); 
           
           $path ='image/sp3k';

           if (!file_exists($path)) {
               mkdir($path, 0777, true);
           }
           if($request->hasFile('file')){
           
               $file = $request->file('file');

               $name = uniqid() . '_' . trim($file->getClientOriginalName());

               $file->move($path, $name);

               $data->file = $name;
               echo "isi_nama";
           }

           $data->save(); 

           $data = Trxkonsumen::findOrfail($request->input("id_spr"));
           $data->sp3k_status = "ACC";
           $data->sp3k_nominal = str_replace(",","",$request->input("nominal_acc"));
           $data->log_kpr = "SP3K";
           $data->log_kpr_bank = $request->input("bank");
           $data->keterangan = "SP3K ACC";
           $data->save();

              //=================Insert Log Konsumen===================================
              $k = new Konsumenlog;
              $k->id_konsumen = $data->id_konsumen;
              $k->id_marketing = $data->id_marketing; 
              $k->id_properti = $data->id_properti; 
              $k->id_kav = $data->id_kav;
              $k->id_spr = $data->id_spr; 
              $k->tanggal = date("Y-m-d"); 
              $k->status = "SP3K"; 
              $k->keterangan = "SP3K ACC - Nama Petugas : ". Auth::user()->name; 
              $k->created_by = Auth::user()->name; 
              $k->save();
               //=================Insert Log Konsumen===================================


           Session::flash('flash_message', 'Data has been successful Edited!');
           return redirect('sp3k');


       }

   }

  
   /**
    * Show the form for editing the specified resource.
    * @param int $id
    * @return Response
    */
   public function edit($id)
   {
       $data = Sp3k::findOrfail($id);
       $bank = $this->data->listbank();
       return view('Sp3k::edit',['bank' => $bank])->with('data', $data) ;
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
           
           return Redirect::to('sp3k/'.$id.'/edit')->withErrors($validator)->withInput();

       } else {

           
           $data = Sp3k::findOrFail($id); 
           $data->bank = $request->input("bank");
           $data->tanggal_sp3k = $request->input("tanggal_sp3k"); 
           $data->nominal_acc = str_replace(",","",$request->input("nominal_acc"));
           $data->jangka_waktu = str_replace(" ","",$request->input("jangka_waktu"));
           $data->angsuran = str_replace(",","",$request->input("angsuran"));
           $data->biaya = str_replace(",","",$request->input("biaya"));
           $data->jenis_kredit =$request->input("jenis_kredit"); 
           
           $path ='image/sp3k';

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

           $data = Trxkonsumen::findOrfail($request->input("id_spr"));
           $data->sp3k_status = "ACC";
           $data->sp3k_nominal = str_replace(",","",$request->input("nominal_acc"));
           $data->log_kpr = "SP3K";
           $data->log_kpr_bank = $request->input("bank");
           $data->keterangan = "SP3K ACC";
           $data->save();
           
           Session::flash('flash_message', 'Data has been successful Edited!');
           return redirect('sp3k');
       }
   }

   /**
    * Remove the specified resource from storage.
    * @param int $id
    * @return Response
    */
   public function destroy($id)
   {
       $users = Sp3k::findOrFail($id);
       $users->delete();
       Session::flash('flash_message', 'Data has ben successful Deleted!');

       return redirect('sp3k');
   }

   /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $a = explode("|",$request->input("query"));
        $kode = $a[0];
        
        $data = Konsumen::select(DB::raw("konsumen.kode,konsumen.nama,idcard,
                                konsumen.alamat,telp,konsumen_spr.id as id_spr,
                                properti.nama as nama_properti,
                                properti_kav.nama as nama_kav,
                                properti_kav.tipe as tipe,
                                konsumen_spr.gross"))
        ->rightjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
        ->rightjoin("properti","konsumen_spr.id_properti","=","properti.id")
        ->rightjoin("properti_kav","konsumen_spr.id_kav","=","properti_kav.id")
        ->where("konsumen_spr.kode","LIKE","%{$kode}%")
        ->get();

        return response()->json($data);       
        
 
    }
 

    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        {
            
                $data = Konsumen::select(DB::raw("nama,idcard,konsumen.kode, konsumen_spr.kode as kode_spr"))
                ->rightjoin("konsumen_spr","konsumen.id","=","konsumen_spr.id_konsumen")
                ->where("konsumen.nama","LIKE","%{$request->input('query')}%")
                ->where("iskonsumen","=",1)
                ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                ->orwhere("konsumen.kode","LIKE","%{$request->input('query')}%")
                ->get();
            
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                    <li><a href="#">'.$row->kode_spr.'|'.$row->nama.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
