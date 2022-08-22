<?php
namespace App\Modules\Surat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Surat extends Model {
    protected $table = 'surat';
    public $timestamps = true; 
}
