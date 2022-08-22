<?php
namespace App\Modules\Suratout\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Suratout extends Model {
    protected $table = 'surat';
    public $timestamps = true; 
}
