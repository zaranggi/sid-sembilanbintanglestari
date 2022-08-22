<?php
namespace App\Modules\Pindahkav\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Tagihan extends Model {
    protected $table = 'tagihan';
    public $timestamps = true;
 
	
	
}
