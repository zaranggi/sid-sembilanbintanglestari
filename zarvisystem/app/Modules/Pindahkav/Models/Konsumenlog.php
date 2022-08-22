<?php
namespace App\Modules\Pindahkav\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Konsumenlog extends Model {
    protected $table = 'konsumen_log';
    public $timestamps = true;
 
	
	
}
