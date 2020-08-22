<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Kontak;

class ControllerKontak extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Kontak::all();
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Empty!";
            return response($res);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $pesan = array(
        //     'kodeproduk.required'    => 'Kode produk dibutuhkan.',
        //     'kodeproduk.unique'      => 'Kode sudah digunakan.',
        //     'kodeproduk.max'         => 'Kode maksimal 10 karakter.', 
        //     'namaproduk.required'    => 'Nama produk dibutuhkan.',          
        //     'namaproduk.unique'      => 'Nama produk sudah digunakan.',
        //     'namaproduk.max'         => 'Nama produk maksimal 100 karakter.',
        //     'status.required'        => 'Pilih jenis status.'       
        // );

        // $aturan = array(
        //     'kodeproduk'      => 'required|unique:produk,produk_kode|max:10',
        //     'namaproduk'      => 'required|unique:produk,produk_name|max:100',
        //     'status'          => 'required'
        // );
        $aturan = array(
            'nama'      => 'required|unique:kontak,nama|max:10',
            'email'     => 'required|unique:kontak,email|max:100',
            'nohp'      => 'required|unique:kontak,nohp|max:5',
            'alamat'    => 'required'
        );
        
        // $validator = Validator::make($request->all(), $aturan, $pesan);
        $validator = Validator::make($request->all(), $aturan);
        if($validator->fails()) {
            $res['status'] = 'Failed!';
            $res['message'] = $validator->errors();
            return response()->json($res, 403);
        } else {
            // use this for send use (in postman->body) form-data, json
            $nama = $request->input('nama');
            $email = $request->input('email');
            $nohp = $request->input('nohp');
            $alamat = $request->input('alamat');

            $data = new Kontak();
            $data->nama = $nama;
            $data->email = $email;
            $data->nohp = $nohp;
            $data->alamat = $alamat;

            // or this for send use (in postman->body) form-data
            // $data = new Kontak();
            // $data->nama = $request->nama;
            // $data->email = $request->email;
            // $data->nohp = $request->nohp;
            // $data->alamat = $request->alamat;

            if($data->save()){
                $res['status'] = 'Success!';
                $res['message'] = $data;
                return response()->json($res, 500);
            }else{
                $res['status'] = 'Failed!';
                return response()->json($res, 403);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Kontak::where('id',$id)->get();
        if(count($data) > 0){ //mengecek apakah data kosong atau tidak
            $res['message'] = "Success!";
            $res['values'] = $data;
            return response($res);
        }
        else{
            $res['message'] = "Failed!";
            return response($res);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $nama = $request->input('nama');
        $email = $request->input('email');
        $nohp = $request->input('nohp');
        $alamat = $request->input('alamat');

        $data = Kontak::where('id', $id)->first();
        $data->nama = $nama;
        $data->email = $email;
        $data->nohp = $nohp;
        $data->alamat = $alamat;

        if($data->save()){
            $res['message'] = 'Success!';
            $res['value'] = "$data";
            return response($res);
        }else{
            $res['message'] = 'Failed!';
            return response($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = Kontak::where('id', $id)->first();

        if($data->delete()){
            $res['message'] = 'Success!';
            $res['value'] = "$data";
            return response($res);
        }else{
            $res['message'] = 'Failed!';
            return response($res);
        }
    }
}
