<?php

namespace App\Http\Controllers;

use App\Models\modelsstatus;
use Illuminate\Http\Request;
use App\Models\modelsviewdata;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Dd;

class viewdatacontroller extends Controller
{   
    public function viewdataall(){
        $biodata_cctv_name =[
            'nama'=>'cctv',
            'tempat'=>'RSUP NTB',
        ];

        $data_tb = modelsviewdata::get();
        $data_status = modelsstatus::get();
        // $data_tb = DB::table("tb_cctv")->get();
        // dd($data_tb);
        return view("pages.viewdata", [
            "biodatacctv"=> $biodata_cctv_name,
            "tampilkansemua"=> $data_tb,
            "dt_status"=> $data_status
        ]);
    }
    public function crudedata(){
        return view("pages.crude");    
    }

    public function store(Request $request){
        $request->validate([
            "ipn_title"=>"required|unique:tb_cctv,title",
            "ipn_ipad"=> "required|unique:tb_cctv,ip_address",
            "ipn_url"=> "required|unique:tb_cctv,stream_url",
        ],[
            "required"=> "tidak boleh kosong",
            "ipn_title.unique"=> "title telah di gunakan",
            "ipn_ipad.unique"=> "ip addres sudah digunakan",
            "ipn_url.unique"=> "url ada",
        ]);
        modelsviewdata::create([
            "title"=> $request->ipn_title,
            "ip_address"=> $request->ipn_ipad,
            "stream_url"=> $request->ipn_url
        ]);
        return redirect("/viewdata")->with("success","data {$request->ipn_title} berhasil di tambahkan");
    }

    public function edit($id){
        $ambildata = modelsviewdata::findOrFail($id);
        
        return view("pages.sub-page.edit", [
            'isidata' => $ambildata,
        ]);
    }

    public function update(Request $request, $id){
        $request->validate([
            "ipn_title"=>"required|unique:tb_cctv,title,$id,id_cctv",
            "ipn_ipad"=> "required|unique:tb_cctv,ip_address,$id,id_cctv",
            "ipn_url"=> "required|unique:tb_cctv,stream_url,$id,id_cctv",
        ],[
            "required"=> "tidak boleh kosong",
            "ipn_title.unique"=> "title telah di gunakan cari yang lain",
            "ipn_ipad.unique"=> "ip addres sudah digunakan",
            "ipn_url.unique"=> "ip addres sudah digunakan",
        ]);

        modelsviewdata::where('id_cctv',$id)->update([
            "title"=> $request->ipn_title,
            "ip_address"=> $request->ipn_ipad
        ]);
        return redirect("/viewdata")->with("success","data {$request->ipn_title} berhasil di ubah");
    }

    public function destroy($id){
        modelsviewdata::findOrFail( $id )->delete();
        return redirect("/viewdata")->with("success","data berhasil di hapus");
    }
}
