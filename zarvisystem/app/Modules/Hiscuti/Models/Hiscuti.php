<?php
namespace App\Modules\Hiscuti\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Hiscuti extends Model {
    protected $table = 'cuti';
    public $timestamps = true;

	
}
