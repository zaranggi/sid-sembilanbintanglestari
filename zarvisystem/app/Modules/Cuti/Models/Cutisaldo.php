<?php
namespace App\Modules\Cuti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Cutisaldo extends Model {
    protected $table = 'cuti_saldo';
    public $timestamps = true;
    public $primarykey = 'id_user';
    
 
	
}
