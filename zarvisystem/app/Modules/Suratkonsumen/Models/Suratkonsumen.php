<?php
namespace App\Modules\Suratkonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Suratkonsumen extends Model {
    protected $table = 'surat_konsumen';
    public $timestamps = true; 
	
	
}
