<?php

namespace App\Modules\Appbonus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Appbonus extends Model {
    protected $table = 'bonus';
    public $timestamps = true; 

       
    public function approve($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('bonus')
            ->where('periode', "$id")
            ->update(['app' => "2", 'tgl_app' => date('Y-m-d')]);  

        return $data; 
    }  
    public function reject($id){ 

        $db = DB::connection('mysql'); 
            
        $data = $db->table('bonus')
            ->where('periode', "$id")
            ->update(['app' => "3", 'tgl_app' => date('Y-m-d')]);  

        return $data; 
    }
    
}
