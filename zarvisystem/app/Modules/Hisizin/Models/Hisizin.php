<?php
namespace App\Modules\Hisizin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Hisizin extends Model {
    protected $table = 'izin';
    public $timestamps = true;

	
}
