<?php
namespace App\Modules\Materialkeluar\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Stmast extends Model {
	protected $table = 'stmast';
	protected $primaryKey = 'prdcd'; // or null	
	public $timestamps = true;
 

 
}
