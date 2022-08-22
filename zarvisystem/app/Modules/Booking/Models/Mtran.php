<?php
namespace App\Modules\Booking\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

/** 
 * @property array|null|string name
 */
class Mtran extends Model {
    protected $table = 'mtran';
    public $timestamps = true;
  
	
}
