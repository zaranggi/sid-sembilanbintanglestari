<?php

namespace App\Modules\Hisabsen\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Hisabsen\Models\Hisabsen;
use App\Modules\Karyawan\Models\Karyawan;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;


use Illuminate\Support\Facades\DB;
use App\Helpers\Tanggal;

class HisabsenController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @param Hisabsen $data
     */

    public function __construct(Hisabsen $data)
    {
        $this->data = $data;
    }
	
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('Hisabsen::index');
    }

     

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'file' => 'required', 
        );
    
        $validator = Validator::make($request->all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return Redirect::to('hisabsen')->withErrors($validator);
        }
        else 
        {
            $path ='image';
            $file_name = "";

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
 
                $file_name = 'absen.xlsx';

                $file->move($path, $file_name); 

                $rows = Excel::toArray([], ($path.'/'.$file_name));
                $db = DB::connection('mysql'); 
                foreach($rows[0] as $r){
                    $sc[] = "('$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]','$r[8]')";
               
                //echo $r[0]."-".$r[1]."-".$r[2]."-".$r[3]."-".$r[4]."-".$r[5]."-".$r[6]."-".$r[7]."-".$r[8];
                  //  echo "<hr/>";
                }
                $im = implode(",", $sc);
                $db->insert("DELETE FROM absen_temp");
                $db->insert("INSERT INTO absen_temp values $im");
                $db->insert("INSERT IGNORE INTO absen
                                (tanggal, name, datang, pulang)
                                select `date` as tanggal , name,min(`time`) as datang, max(`time`) as pulang  
                                FROM absen_temp group by `date`,name");

            }
            Session::flash('flash_message', 'Absen Berhasil di-Update!');
            return redirect('hisabsen'); 

        } 
    }

     
    public function preview(Request $request)
    {
        $tanggal1 = $request->input("tanggal1");
        $tanggal2 = $request->input("tanggal2");

        $data = Hisabsen::whereBetween("tanggal",[$tanggal1,$tanggal2])
                ->OrderBy("tanggal","asc")->get();

        return view('Hisabsen::preview',['data' => $data]);

    }

    
}
