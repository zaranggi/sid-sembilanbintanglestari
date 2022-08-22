<?php
namespace App\Modules\Mrabp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Prodmastp extends Model {
    protected $table = 'prodmast';
	protected $primaryKey = 'prdcd'; // or null
    public $timestamps = true;
 
}
