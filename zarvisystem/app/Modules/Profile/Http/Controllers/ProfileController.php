<?php

namespace App\Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use Illuminate\Support\Facades\Auth;
use App\Modules\Profile\Models\Profile;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Input;

/**
 * @property Profile data
 */
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Profile $data
     */
    public function __construct(Profile $data)
    {
        $this->data = $data;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->karyawan(Auth::user()->nik); 

        return view('Profile::index' , ['data'=> $data ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ubah(Request $request)
    {
        if(!empty($request->input('password')))
        {
                $rules = array(
                                'password' => 'min:6',
                            );
        }elseif($request->hasFile('file')){
            $rules = array(
                'file' => 'required|image|mimes:jpeg,jpg|max:512',
            );
        }else{
            $rules = array( );
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('profile')->withErrors($validator)->withInput();
        } else {
 
            // read image from temporary file
            if ($request->hasFile('file')) {
                $file_name = "usr_".Auth::user()->nik.".jpg";

                $this->data->updatefoto($file_name);

                Image::make(Input::file('file'))->resize(320, 320)->save('images/listuser/'.$file_name);
            }
            $id = Auth::user()->id;    
            $data = Profile::findOrFail($id);
            $data->name 	= $request->input('name'); 
            $data->email    = $request->input('email'); 
            $data->username = $request->input('username');  
            if(!empty($request->input('password')))
            {
                $data->password = bcrypt($request->input('password'));
            }

            $data->save();
            $request->session()->flash('flash_message', 'Data has ben successful Edited!');

            return redirect('profile'); 
             
        }
    }

    public function updatequotes(Request $request)
    {

        $rules = array(
            'quotes' => 'required|max:500'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('home')->withErrors($validator)->withInput();
        } else {

            $a = $request->input('quotes');
            $this->data->updatequotes($a);

            return response()->json(['success'=>'Quotes Anda Sukses terikirim']);
        }

    }


}
