<?php

namespace App\Modules\Fukonsumen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Fukonsumen\Models\Fukonsumen;
use App\Modules\Konsumen\Models\Konsumen;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class FukonsumenController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @param Fukonsumen $data
     */

    public function __construct(Fukonsumen $data)
    {
        $this->data = $data;
    }

    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $listprogres = $this->data->listprogres();
        $properti = $this->data->list();
        
        return view("Fukonsumen::index", ['listprogres' => $listprogres,'properti' => $properti,]);
 
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function isikan(Request $request)
    {
        $kode = substr($request->input("query"),0,7);
        
        $data = Konsumen::select(DB::raw("konsumen.id,properti.nama as nama_properti,
                konsumen.kode,konsumen.nama,idcard,konsumen.alamat,telp,id_properti,id_marketing")) 
        ->leftjoin("properti","konsumen.id_properti","=","properti.id")
        ->where("konsumen.kode","LIKE","%{$kode}%")
        ->get();

        return response()->json($data);
         
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function fu(Request $request)
    {
        
        $kode = substr($request->input('kode'),0,7);
        $aa = Konsumen::where('kode',$kode)->count();
 
            if($aa > 0){
                
                $aa = Konsumen::where('kode',$kode)->take(1)->get();
                foreach($aa as $kon){
                    
                    $this->data->updatekonsumen($kode,$request->input('nama'),$request->input('alamat'),$request->input('telp'),str_replace(" ","",$request->input('idcard')));
                    
                    $datax = new Fukonsumen;
                    $datax->id_konsumen = $kon->id;
                    $datax->id_properti = $kon->id_properti;
                    $datax->id_marketing = $kon->id_marketing;
                    $datax->id_progres = $request->input('id_progres');
                    $datax->created_by = Auth::user()->name; 
                    $datax->tanggal = $request->input('tanggal');
                    $datax->melalui = $request->input('melalui');
                    $datax->keterangan = $request->input('keterangan');
                    $datax->hasil = $request->input('hasil');
                    $datax->save();
                    
                }
                
            }else{
            
                $noUrutAkhir = Konsumen::max('id');
                $kode = "KO-".sprintf("%04s", $noUrutAkhir + 1);
                
                $data = new Konsumen;  
                $data->id_properti = $request->input("id_properti"); 
                $data->id_marketing = Auth::user()->id;    
                $data->kode             = $kode;            
                $data->nama         	= $request->input('nama');
                $data->alamat 	        = $request->input('alamat'); 
                $data->telp          	= $request->input('telp');   
                $data->idcard          	= str_replace(" ","",$request->input('idcard'));   
                $data->save(); 

                $datau = new Fukonsumen;
                $datau->id_konsumen = $data->id;
                $datau->id_properti = $data->id_properti;
                $datau->id_marketing = $data->id_marketing;
                $datau->id_progres = $request->input('id_progres');
                $datau->created_by = Auth::user()->name;
                $datau->tanggal = $request->input('tanggal');
                $datau->melalui = $request->input('melalui');
                $datau->keterangan = $request->input('keterangan');
                $datau->hasil = $request->input('hasil');
                $datau->save(); 

            }
            $pesan = "Report - Aktifitas Marketing
Nama Mafketing: ".Auth::user()->name."
Tanggal: ".$request->input('tanggal')."
Nama Konsumen: ".$request->input('nama')."
Alamat: ".$request->input('alamat')."
Keterangan:".$request->input('keterangan');
            DB::table('wa')->insert([
                'pesan' => $pesan,
                'status_wa'=> 0,
            ]);
         
        Session::flash('flash_message', 'Data has been successful Added!');
        return redirect('fukonsumen'); 
    }




    public function autocomplete(Request $request)
    {
        if($request->get('query'))
        { 
             
                $data = Konsumen::select(DB::raw("nama,idcard,kode"))
                ->where('id_marketing','=',Auth::user()->id)
                ->where("nama","LIKE","%{$request->input('query')}%")
                ->orwhere("idcard","LIKE","%{$request->input('query')}%")
                ->orwhere("kode","LIKE","%{$request->input('query')}%")
                ->get();
            

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
                    <li><a href="#">'.$row->kode.'-'.$row->nama.'</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
  
}
