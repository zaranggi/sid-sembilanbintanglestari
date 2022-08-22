<?php
namespace App\Modules\Sldawal\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property array|null|string name
 */
class Closing extends Model {
    protected $table = 'acc_closing';
    public $timestamps = true;
  
}
