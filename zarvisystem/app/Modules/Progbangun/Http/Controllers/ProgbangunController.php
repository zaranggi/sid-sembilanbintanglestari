<?php

namespace App\Modules\Progbangun\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Modules\Progbangun\Models\Progbangun;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Modules\Spk\Models\Progresbangun;
use DB;
class ProgbangunController extends Controller
{
    public function __construct(Progbangun $data)
    {
        $this->data = $data;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = $this->data->dataall();
        return view('Progbangun::index', ['data' => $data]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function edit($id)
    {

		$data= $this->data->detail($id);

		return view("Progbangun::edit",['data' => $data, 'id'=>$id ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function simpan(Request  $request)
    {
        $rules = array(
            'id' => 'required|numeric',
        );

        $validator =Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('progbangun/'.$request->input("id_spr").'/edit')->withErrors($validator)->withInput();
        }
        else
        {

			$data = Progresbangun::findOrFail($request->input("id"));

            $namafile1 = "";
            if ($request->hasFile('photo1')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $request->file('photo1');
                $namafile1 = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $namafile1);

				$data->photo1 		= $namafile1;

            }
            $namafile2 = "";
            if ($request->hasFile('photo2')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $request->file('photo2');
                $namafile2 = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $namafile2);

				$data->photo2 		= $namafile2;
            }
            $namafile3 = "";
            if ($request->hasFile('photo3')) {
                $path ='image/project';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $file = $request->file('photo3');
                $namafile3 = uniqid() . '_' . trim($file->getClientOriginalName());
                $file->move($path, $namafile3);

				$data->photo3 		= $namafile3;
            }


            $data->status 		= $request->input('status');
            $data->save();


            Session::flash('flash_message', 'Data has ben successful Edited!');
            return redirect('progbangun/'.$request->input("id").'/edit');

        }
    }

}
