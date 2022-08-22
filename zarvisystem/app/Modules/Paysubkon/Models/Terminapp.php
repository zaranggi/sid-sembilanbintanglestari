<?php
namespace App\Modules\Paysubkon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Terminapp extends Model {
    protected $table = 'termin_approval';
    public $timestamps = true;

	
}
