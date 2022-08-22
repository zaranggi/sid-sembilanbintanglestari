<?php



namespace App\Modules\Kegharian\Http\Controllers;



use Illuminate\Http\Request;

use Illuminate\Http\Response;

use Illuminate\Routing\Controller;
  
 
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;

use App\Modules\Kegharian\Models\Kegharian;
use App\Modules\Konsumen\Models\Konsumen;



class KegharianController extends Controller

{

    

        /**

     * Display a listing of the resource.

     *

     * @param Kegharian $data

     */ 
    public function __construct(Kegharian $data)

    {

        $this->data = $data;

    }

    /**

     * Display a listing of the resource.

     * @return Response

     */

    public function index() 
    { 

        $properti = $this->data->list();

        return view('Kegharian::index',['properti' => $properti]);

    } 
    /**

     * Store a newly created resource in storage.

     * @param Request $request

     * @return Response

     */

    public function store(Request $request)
    {  

        $data = new Kegharian; 

        $data->id_properti = $request->input("id_properti");

        $data->id_marketing = Auth::user()->id; 

        $data->nama_konsumen = strtoupper($request->input('nama'));

        $data->alamat = $request->input('alamat');

        $data->phone = $request->input('phone');

        $data->tanggal = $request->input('tanggal');

        $data->melalui = $request->input('melalui');

        $data->keterangan = $request->input('keterangan'); 

        $data->created_by = Auth::user()->name; 

        $data->save();


        $noUrutAkhir = Konsumen::max('id');
        $kode = "KO-".sprintf("%04s", $noUrutAkhir + 1);
        
        $data = new Konsumen;  
        $data->id_properti = $request->input("id_properti"); 
        $data->id_marketing = Auth::user()->id;    
        $data->kode             = $kode;            
        $data->nama         	= strtoupper($request->input('nama'));
        $data->alamat 	        = $request->input('alamat'); 
        $data->telp          	= $request->input('phone');   
        $data->save(); 

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
        Session::flash('flash_message', 'Data Berhasil disimpan!');

        return redirect('kegharian');

    }



     

}

