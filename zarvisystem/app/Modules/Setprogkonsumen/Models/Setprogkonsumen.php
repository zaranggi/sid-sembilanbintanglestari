<?php
namespace App\Modules\Setprogkonsumen\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Setprogkonsumen extends Model {
    protected $table = 'jenis_progres_konsumen';
    public $timestamps = true; 
}
