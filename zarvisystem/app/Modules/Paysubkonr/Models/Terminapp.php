<?php
namespace App\Modules\Paysubkonr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Terminapp extends Model {
    protected $table = 'termin_proyek_approval';
    public $timestamps = true;

	
}
