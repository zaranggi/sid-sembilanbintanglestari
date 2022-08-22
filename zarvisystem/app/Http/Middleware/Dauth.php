<?php
namespace App\Http\Middleware;
use App\Modules\AuthMenu;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/**

 * @property mixed AuthMenu

 */

class Dauth
{

    /**

     * Handle an incoming request.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Closure  $next

     * @return mixed

     */

    public $attributes;

    public function handle(Request $request, Closure $next)

    {

        if($request->user()->is_blocked==1)
        {
            auth()->logout();
            $message = 'Maaf Akun Anda telah di Block.';
            return redirect()->route('login')->withMessage($message);

        }
        
        if(Auth::user()->reset_pass == 1) 
        { 
            $message = 'Silahkan Ubah Password Anda';
            return redirect('resetpass')->with('id',$message);

        }

        $routes = Route::current();
		
        $routes = explode("/",$routes->uri); 
        
          if($routes[0] != "home" && $routes[0] != "resetpass")
          { 
              
                    $cek_coy = explode(".", Route::current()->getName());

                    $this->AuthMenu = AuthMenu::AuthMenu(Auth::user()->id_jabatan, $routes[0]);

                    $request->session()->flash('menuku',  $this->AuthMenu);

                    /*
                    if($this->AuthMenu->count() == 0)
                    {
                         abort(403, 'Unauthorized action.');

                    }
                    elseif(!empty($routes[1]))
                    {
                            if($routes[1] == "create"){
                                $this->AuthMenu = AuthMenu::AuthMenuAdd(Auth::user()->id, $routes[0]);
                                if($this->AuthMenu->count() == 0)
                                {
                                    abort(403, 'Unauthorized action.');
                                }
                            }
                            elseif(!is_null(Route::current()->getName()) && $cek_coy[1] == "destroy"){
                                $this->AuthMenu = AuthMenu::AuthMenuDelete(Auth::user()->id, $cek_coy[0]);
                                if ($this->AuthMenu->count() == 0) {
                                    abort(403, 'Unauthorized action.');
                                }
                            }
                            elseif(!empty($routes[2]))
                            {
                                if($routes[2] == "edit"){

                                    $this->AuthMenu = AuthMenu::AuthMenuEdit(Auth::user()->id, $routes[0]);
                                    if ($this->AuthMenu->count() == 0) {
                                        abort(403, 'Unauthorized action.');
                                    }
                                }

                            }

                     }
                     */
              }


        return $next($request);

    }

}

