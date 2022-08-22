<?php
namespace App\Modules\Kpr\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Tagihankpr extends Model {
    protected $table = 'tagihan';
    public $timestamps = true;

		
}
