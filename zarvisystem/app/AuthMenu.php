<?php
namespace App\Modules;

use Illuminate\Database\Eloquent\Model;

class AuthMenu extends Model
{
    protected $table = 'menu';

    /**

     * @param $user
 
     * @param $route

     * @return mixed

     */

    public static function AuthMenu($user,$routes)
    {
        $AuthMenu = MenuModel::where('active','=',  'Y')
            ->where('link','=',  $routes)
            ->where('auth_access', 'like', '%#'.$user.'#%')
            ->get();
        return $AuthMenu;
    }



    public static function AuthMenuAdd($user,$routes)
    {
        $AuthMenu = MenuModel::where('active','=',  'Y')
            ->where('link','=',  $routes)
            ->where('auth_add', 'like', '%#'.$user.'#%') 
            ->get();
        return $AuthMenu;
    }



    public static function AuthMenuEdit($user,$routes)
    {
        $AuthMenu = MenuModel::where('active','=',  'Y')
            ->where('link','=',  $routes)
            ->where('auth_update', 'like', '%#'.$user.'#%') 
            ->get();

        return $AuthMenu;
    }



    public static function AuthMenuDelete($user,$routes)
    {
        $AuthMenu = MenuModel::where('active','=',  'Y')
            ->where('link','=',  $routes)
            ->where('auth_delete', 'like', '%#'.$user.'#%') 
            ->get();

        return $AuthMenu;

    }

}

