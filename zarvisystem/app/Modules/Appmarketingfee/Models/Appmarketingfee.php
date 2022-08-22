<?php
namespace App\Modules\Appmarketingfee\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Appmarketingfee extends Model {
    protected $table = 'marketing_fee';
    public $timestamps = true; 

    public function listdata()
	{	
		$db = DB::connection('mysql');
		
		$listuser = $db->select("select c.`name` as nama_marketing, id_fee, tanggal,
            sum(a.gross) as total,
            count(*) as tkonsumen,approve,
            if(a.approve=1,'Pengajuan',if(a.approve = 2,'Di Setujui','Di Tolak')) as status,
            if(a.tgl_approve = '0000-00-00 00:00:00','',a.tgl_approve) as tgl_approve
            from marketing_fee a 
            left join konsumen_spr b on a.id_trx_konsumen = b .id
            left join users c on a.id_marketing = c.id
            group by id_fee order by a.created_at desc
        ");
		 return $listuser;
	}
    public function listkonsumen()
	{	
		$db = DB::connection('mysql');
		
		$listuser = $db->select("select a.id,b.nama as nama_properti, c.nama as nama_kav,d.nama as nama_konsumen from konsumen_spr a
        left join properti b on a.id_properti = b.id 
        left join properti_kav c on a.id_kav = c.id
        left join konsumen d on a.id_konsumen = d.id
        where a.status_spr = 1 order by nama_konsumen
        ");
		 return $listuser;
	}  

    public function approve($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('marketing_fee')
            ->where('id_fee', "$id")
            ->update(['approve' => "2", 'tgl_approve' => date('Y-m-d')]);  

        return $data; 
    }  
    public function reject($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('marketing_fee')
            ->where('id_fee', "$id")
            ->update(['approve' => "3", 'tgl_approve' => date('Y-m-d')]);  

        return $data; 
    }



}
