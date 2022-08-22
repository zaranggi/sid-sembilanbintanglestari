<?php
namespace App\Modules\Materialmasuk\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Prodmast extends Model {
	protected $table = 'prodmast';
	protected $primaryKey = 'prdcd'; // or null	
	public $timestamps = true;
 

 
}
