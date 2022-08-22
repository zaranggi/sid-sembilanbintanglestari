<?php

namespace App\Modules\Menu\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Modules\Menu\Menu;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

/**
 * @property Menu data
 */
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Menu $data
     */
    public function __construct(Menu $data)
    {
        $this->data = $data;
    }

    public function index()
    {
        $listmenu = Menu::all();
        return view("Menu::index", ['listmenu' => $listmenu]);
    }


    public function create()
    {
         
        $listmenu = $this->data->menuku();
        $listdepartment = $this->data->listdepartment();
        $listjabatan = $this->data->listjabatan();
        //$listmenu = menu::all();
        return view("Menu::create", ['listmenu' => $listmenu,
            'listjabatan' => $listjabatan,
            'listdepartment' => $listdepartment
        ]);
        
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = array(
            'name_menu' => 'required|max:255',
            'auth_access' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('menu/create')->withErrors($validator)->withInput();
        }
        else
        {
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            is_array($request->input('id_department')) ? $id_department = implode(" ",$request->input('id_department')) : $id_department ="";
            is_array($request->input('auth_access')) ? $auth_access = implode(" ",$request->input('auth_access')) : $auth_access ="";
            is_array($request->input('auth_add')) ? $auth_add = implode(" ",$request->input('auth_add')) : $auth_add ="";
            is_array($request->input('auth_update')) ? $auth_update = implode(" ",$request->input('auth_update')) : $auth_update ="";
            is_array($request->input('auth_delete')) ? $auth_delete = implode(" ",$request->input('auth_delete')) : $auth_delete ="";
            is_array($request->input('auth_upload')) ? $auth_upload = implode(" ",$request->input('auth_upload')) : $auth_upload ="";

            $data = new Menu;
            $data->name_menu 	= $request->input('name_menu');
            $data->link 		= $request->input('link','#');
            $data->id_main 		= $request->input('id_main',0);
            $data->active 		= $active;
            $data->icon 	= $request->input('icon');
            $data->id_dep 	= $id_department;
            $data->auth_access 	= $auth_access;
            $data->auth_add 	= $auth_add;
            $data->auth_update 	= $auth_update;
            $data->auth_delete 	= $auth_delete;
            $data->auth_upload 	= $auth_upload;
            $data->save();

            Session::flash('flash_message', 'Data has ben successful Added!');
            return redirect('menu');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {

        $menu = Menu::findOrFail($id);

        $listdepartment = $this->data->listdepartment();
        $listmenu = $this->data->menuku();
        $listjabatan = $this->data->listjabatan();

        return view("Menu::edit", ['listmenu' => $listmenu,
            'listjabatan' => $listjabatan,
            'listdepartment' => $listdepartment
        ])->with('menu', $menu);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update($id, Request  $request)
    {
        $rules = array(
            'name_menu' => 'required|max:255',
            'auth_access' => 'required',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('menu/'.$id.'/edit')->withErrors($validator)->withInput();
        }
        else
        {
            is_array($request->input('id_department')) ? $id_department = implode(" ",$request->input('id_department')) : $id_department ="";
            is_array($request->input('auth_access')) ? $auth_access = implode(" ",$request->input('auth_access')) : $auth_access ="";
            is_array($request->input('auth_add')) ? $auth_add = implode(" ",$request->input('auth_add')) : $auth_add ="";
            is_array($request->input('auth_update')) ? $auth_update = implode(" ",$request->input('auth_update')) : $auth_update ="";
            is_array($request->input('auth_delete')) ? $auth_delete = implode(" ",$request->input('auth_delete')) : $auth_delete ="";
            is_array($request->input('auth_upload')) ? $auth_upload = implode(" ",$request->input('auth_upload')) : $auth_upload ="";

            $menu = Menu::findOrFail($id);
            $active = ($request->input('active') == "on") ? 'Y' : 'N';
            $menu->name_menu 	= $request->input('name_menu');
            $menu->link 		= $request->input('link','#');
            $menu->id_main 		= $request->input('id_main',0);
            $menu->active 		= $active;
            $menu->icon 		= $request->input('icon');
            $menu->id_dep 	= $id_department;
            $menu->auth_access 	= $auth_access;
            $menu->auth_add 	= $auth_add;
            $menu->auth_update 	= $auth_update;
            $menu->auth_delete 	= $auth_delete;
            $menu->auth_upload 	= $auth_upload;

            /** @var TYPE_NAME $menu */
            $menu->save();
            //	echo $auth_access;

            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('menu');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        Session::flash('flash_message', 'Data has ben successful Deleted!');
        return redirect('menu');
    }

}
