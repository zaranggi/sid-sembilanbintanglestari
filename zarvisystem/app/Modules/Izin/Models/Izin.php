<?php
namespace App\Modules\Izin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
/**
 * @property array|null|string name
 */
class Izin extends Model {
    protected $table = 'izin';
    public $timestamps = true;
 
	
}
