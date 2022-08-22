<?php

namespace App\Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Home\Models\Home;
//use App\Modules\Konsumen\Models\Konsumen;
//use App\Modules\Trxkonsumen\Models\Trxkonsumen;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @param Home $data
     */

    public function __construct(Home $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
         
        $perumahan = $this->data->perumahan();
        foreach($perumahan as $r)
        {
            $nama_perumahan = $r->nama;
            $id = $r->id;
            $jual = $this->data->jual($id,date("Y-m-d"));
            foreach($jual as $rj){
                $rjual = $rj->jual;
                $t[] = "{
                    name: '$nama_perumahan',
                    data: [$rjual],
                    stack: '$nama_perumahan'
            
                }";
            } 
            //line chart
            $line = $this->data->line1($id,date("Y-m-d")); 
            foreach($line as $rl){

                $sta[] = "{'y' : ".$rl->bulan.", 'masuk': $rl->masuk,'proses': ".$rl->proses.", 'acc': ".$rl->acc.", 'tolak': ".$rl->tolak." }";

            }
            $gst[$id] = implode(",",$sta);  
            
            $donat = $this->data->donat($id);
            foreach($donat as $rd){

                $don[] = "{'label' : '".$rd->nama."', 'value': ".$rd->total."}";

            }
            $rdonat[$id] = implode(",",$don);  

            unset($sta);    
            unset($don);            
            
        }

        $gab = implode(",",$t);
        $kprall = $this->data->kprall(date("Y"));
        $kpr = $this->data->kpr(date("Y"));
 
        return view("Home::index", 
                        [
                            'perumahan' => $perumahan,
                            'gab' => $gab,
                            'kprall' => $kprall,
                            'kpr' => $kpr,
                            'gst' => $gst,
                            'rdonat' => $rdonat,
                        ]); 
    }
    public function data($year)
    {
        if($year == date("Y")){
            $periode = date("Y-m-d");
        }else{
            $periode = $year."-12-31";
        }
        $perumahan = $this->data->perumahan();
        foreach($perumahan as $r)
        {
            $nama_perumahan = $r->nama;
            $id = $r->id;
            $jual = $this->data->jual($id,$periode);
            foreach($jual as $rj){
                $rjual = $rj->jual;
                $t[] = "{
                    name: '$nama_perumahan',
                    data: [$rjual],
                    stack: '$nama_perumahan'
            
                }";
            } 
            //line chart
            $line = $this->data->line1($id,$periode); 
            foreach($line as $rl){

                $sta[] = "{'y' : ".$rl->bulan.", 'masuk': $rl->masuk,'proses': ".$rl->proses.", 'acc': ".$rl->acc.", 'tolak': ".$rl->tolak." }";

            }
            $gst[$id] = implode(",",$sta);  
            
            $donat = $this->data->donat($id);
            foreach($donat as $rd){

                $don[] = "{'label' : '".$rd->nama."', 'value': ".$rd->total."}";

            }
            $rdonat[$id] = implode(",",$don);  

            unset($sta);    
            unset($don);            
            
        }

        $gab = implode(",",$t);
        $kprall = $this->data->kprall($periode);
        $kpr = $this->data->kpr($periode);
 
        return view("Home::index2", 
                        [
                            'perumahan' => $perumahan,
                            'gab' => $gab,
                            'kprall' => $kprall,
                            'kpr' => $kpr,
                            'gst' => $gst,
                            'rdonat' => $rdonat,
                            'tanggal' => $year
                        ]); 
    }


     
}
