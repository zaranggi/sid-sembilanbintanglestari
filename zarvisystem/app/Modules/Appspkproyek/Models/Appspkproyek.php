<?php
namespace App\Modules\Appspkproyek\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
/**
 * @property array|null|string name
 */
class Appspkproyek extends Model {
    protected $table = 'spk_proyek';
    public $timestamps = true; 
 
    public function dataall()
	{
        $db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 5  ){
            $listuser = $db->table('spk_proyek')
            ->select(db::raw("spk_proyek.*, properti.nama as nama_properti, mrab_proyek.judul"))
            ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")
            ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")    
            ->where("spk_proyek.status","<>","0")
            ->where("mrab_proyek.kategori","=","Proyek")
            ->OrderBy('spk_proyek.id', 'DESC')->get();	 
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 OR  Auth::user()->id_jabatan == 1){
            $listuser = $db->table('spk_proyek')
            ->select(db::raw("spk_proyek.*, properti.nama as nama_properti, mrab_proyek.judul"))
            ->leftjoin("mrab_proyek","spk_proyek.id_mrabp","=","mrab_proyek.id")
            ->leftjoin("properti","spk_proyek.id_properti","=","properti.id")    
            ->wherein("spk_proyek.status",[2,4,5])
            ->where("mrab_proyek.kategori","=","Proyek")
            ->OrderBy('spk_proyek.id', 'DESC')->get();	 
        }
	
           
        return $listuser;
    }	 
    public function approve($idspk){ 

        $db = DB::connection('mysql');
        
        if(Auth::user()->id_jabatan == 5 ){
            $data = $db->table('spk_proyek')
            ->where('id', $idspk)
            ->update(['status' => "2", 'app_mgr' => date('Y-m-d')]);
            
            $data = $db->table('termin_proyek')
            ->where('id_spk', $idspk)
            ->update(['app_mgr' =>date("Y-m-d")]);

            $datanya = Appspkproyek::findOrFail($idspk);
            $pesan = "Anda memiliki Pending Approval atas Pengajuan SPK Proyek <br>
					<strong>Data SPK</strong><br>
					<strong>Kode SPK: </strong>". $datanya->kode."<br>
					<strong>Tanggal SPK: </strong>". $datanya->tanggal."<br>
					<strong>Nilai : </strong>". number_format($datanya->gross_total)."<br>
					<strong>Tanggal Mulai/BAST: </strong>". $datanya->tanggal_mulai." s/d ".$datanya->tanggal_bast."<br>
					<strong>Diajukan Oleh : </strong>". $datanya->created_by."<br>
					
					";				
            Mail::send('email', ['data' => $data,'pesan' =>$pesan ], function ($message) use ($request)
            {
                $message->subject("New Approval :: Pengajuan SPK Proyek"); 
                $message->from('admin@sembilanbintanglestari.com', 'PT Sembilan Bintang Lestari');
                $message->to("harishfauzan@gmail.com");
                //$message->to("donnyirianto.anggriawan@gmail.com");
            });
            
            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('spk_proyek')
            ->where('id', $idspk)
            ->update(['status' => "4", 'app_dir' => date('Y-m-d')]);

            $data = $db->table('termin_proyek')
            ->where('id_spk', $idspk)
            ->update(['apprej' => 1, 
                        'apptgl' =>date("Y-m-d"), 
                        'status' => 2,
                        'app_dir' =>date("Y-m-d")]);

        }
        

        return $data;


        
    }
    
    public function reject($idspk){ 

		$db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 5 ){
            $data = $db->table('spk_proyek')
            ->where('id', $idspk)
            ->update(['status' => "3", 'app_mgr' => date('Y-m-d')]);

            $data = $db->table('termin_proyek')
            ->where('id_spk', $idspk)
            ->update(['apprej' => 0, 
                        'apptgl' =>date("Y-m-d"), 
                        'app_mgr' => date('Y-m-d'),
                        'status' => 3]);

            
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3){
            $data = $db->table('spk_proyek')
            ->where('id', $idspk)
            ->update(['status' => "5", 'app_dir' => date('Y-m-d')]);

            $data = $db->table('termin_proyek')
            ->where('id_spk', $idspk)
            ->update(['apprej' => 0, 
                        'apptgl' =>date("Y-m-d"), 
                        'app_dir' => date('Y-m-d'),
                        'status' => 3]);

        }
        return $data;
        
	}
	
	public function spkdetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("select
                                a.*,
                                b.name as nama_pihak1,
                                c.nama as nama_subkon,
                                e.nama as nama_properti,
								d.judul
                                from spk_proyek a
                                left join users b on a.pihak1 = b.id
                                left join subkon c on a.id_subkon = c.id
                                left join properti e on a.id_properti = e.id
                                left join mrab_proyek d on a.id_mrabp = d.id
						where a.id = $idspk");
       
        return $data;
        
	}
	
	public function termindetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("select * from termin_proyek where id_spk = $idspk");
       
        return $data;
        
	}
	
	public function jobdetail($idspk){ 

		$db = DB::connection('mysql');
        $data = $db->select("
					select a.*, d.nama as nama_pekerjaan 
					from progres_proyek a
					left join jenis_progres_proyek d on a.id_pekerjaan = d.id
					where a.id_spk = $idspk;");
       
        return $data;
        
    }


}
