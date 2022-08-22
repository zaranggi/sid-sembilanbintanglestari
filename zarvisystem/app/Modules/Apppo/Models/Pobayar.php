<?php
namespace App\Modules\Apppo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Pobayar extends Model {
    protected $table = 'po_bayar';
    public $timestamps = true;


}
