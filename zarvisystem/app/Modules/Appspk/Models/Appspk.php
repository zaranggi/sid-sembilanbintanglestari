<?php
namespace App\Modules\Appspk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Modules\Progbangun\Models\Progbangun;

/**
 * @property array|null|string name
 */
class Appspk extends Model {
    protected $table = 'spk';
    public $timestamps = true;

    public function dataall()
	{
        $db = DB::connection('mysql');
        if(Auth::user()->id_jabatan == 5 OR Auth::user()->id_jabatan == 1 ){
            $listuser = $db->table('spk')
            ->select(db::raw("spk.*, properti.nama as nama_properti,
            properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit,nama_spk"))
            ->leftjoin("properti","spk.id_properti","=","properti.id")
            ->leftjoin("properti_kav","spk.id_kav","=","properti_kav.id")
            ->leftjoin("jenis_spk","spk.id_jenis","=","jenis_spk.id")
            ->where("spk.status","<>","0")
            ->OrderBy('spk.id', 'DESC')->get();
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 ){
            $listuser = $db->table('spk')
            ->select(db::raw("spk.*, properti.nama as nama_properti, properti_kav.nama as nama_kav,properti_kav.tipe as tipe_unit,nama_spk"))
            ->leftjoin("properti","spk.id_properti","=","properti.id")
            ->leftjoin("properti_kav","spk.id_kav","=","properti_kav.id")
            ->leftjoin("jenis_spk","spk.id_jenis","=","jenis_spk.id")
            ->wherein("spk.status",[2,4,5])
            ->OrderBy('spk.id', 'DESC')->get();
        }


        return $listuser;
    }
    public function approve($idspk){

        $db = DB::connection('mysql');

        if(Auth::user()->id_jabatan == 5 ){
            $data = $db->table('spk')
            ->where('id', $idspk)
            ->update(['status' => "2", 'app_mgr' => date('Y-m-d')]);

            $data = $db->table('termin')
            ->where('id_spk', $idspk)
            ->update(['app_mgr' =>date("Y-m-d")]);

            $datanya = Appspk::findOrFail($idspk);
            $pesan = "Anda memiliki Pending Approval atas Pengajuan SPK
Data SPK
Kode SPK:". $datanya->kode."
Tanggal SPK: ". $datanya->tanggal."
Nilai : Rp ". number_format($datanya->gross_total)."
Tanggal Mulai/BAST: ". $datanya->tanggal_mulai." s/d ".$datanya->tanggal_bast."
Diajukan Oleh : ". $datanya->created_by;

DB::table('wa')
->insert(
            [
                'pesan' => $data,
                'status_wa'=> 0,
            ]
        );
        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3 OR Auth::user()->id_jabatan == 1){
            $datanya = Appspk::findOrFail($idspk);

            $mt = new Progbangun;
            $mt->id_spk 	    = $idspk;
            $mt->id_properti    = $datanya->id_properti;
            $mt->id_kav         = $datanya->id_kav;
            $mt->tipe_unit 	    =  $datanya->tipe_unit;
            $mt->id_mrab 	    =  $datanya->kode_mrab;
            $mt->status 	    =  0;
            $mt->save();



            $data = $db->table('spk')
            ->where('id', $idspk)
            ->update(['status' => "4", 'app_dir' => date('Y-m-d')]);

            $data = $db->table('termin')
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
        if(Auth::user()->id_jabatan == 5 OR Auth::user()->id_jabatan == 1){
            $data = $db->table('spk')
            ->where('id', $idspk)
            ->update(['status' => "3", 'app_mgr' => date('Y-m-d')]);

            $data = $db->table('termin')
            ->where('id_spk', $idspk)
            ->update(['apprej' => 0,
                        'apptgl' =>date("Y-m-d"),
                        'app_mgr' => date('Y-m-d'),
                        'status' => 3]);


        }elseif(Auth::user()->id_jabatan == 4 OR Auth::user()->id_jabatan == 3){
            $data = $db->table('spk')
            ->where('id', $idspk)
            ->update(['status' => "5", 'app_dir' => date('Y-m-d')]);

            $data = $db->table('termin')
            ->where('id_spk', $idspk)
            ->update(['apprej' => 0,
                        'apptgl' =>date("Y-m-d"),
                        'app_dir' => date('Y-m-d'),
                        'status' => 3]);

        }
        return $data;

	}

	public function spk($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("select
                                a.*,
                                b.name as nama_pihak1,
                                c.nama as nama_subkon,
                                e.nama as nama_properti,
                                f.nama as nama_kav,
                                f.tipe as tipe_unit,
                                h.nama_spk
                                from spk a
                                left join users b on a.pihak1 = b.id
                                left join subkon c on a.id_subkon = c.id
                                left join properti e on a.id_properti = e.id
                                left join properti_kav f on a.id_kav = f.id
                                left join jenis_spk h on a.id_jenis = h.id
						where a.id = $idspk");

        return $data;

	}

	public function termin($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("select * from termin where id_spk = $idspk");

        return $data;

	}

	public function job($idspk){

		$db = DB::connection('mysql');
        $data = $db->select("
                    select a.*,b.bobot, c.nama_spk, d.nama as nama_pekerjaan
                    from progres_bangun a
					left join spk b on a.id_spk = b.id
					left join jenis_spk c on a.jenis_spk = c.id
					left join jenis_progres_kategori d on a.id_pekerjaan = d.id
					where b.id = $idspk;
		");

        return $data;

	}


}
