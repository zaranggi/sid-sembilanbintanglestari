<?php
namespace App\Modules\Paysubkonp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Spk extends Model {
    protected $table = 'spk_proyek';
    public $timestamps = true;

	
}
