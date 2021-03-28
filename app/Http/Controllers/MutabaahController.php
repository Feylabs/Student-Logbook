<?php

namespace App\Http\Controllers;

use App\Models\Mutabaah;
use Illuminate\Http\Request;

class MutabaahController extends Controller
{
    function viewAdminCreate(){
        return view('admin.mutabaah.create');
    }

    function viewAdminManage(){
        return view('admin.mutabaah.manage');
    }

    function store(Request $request){

        $rules = [
            "judul" => "required",
            "status" => "required",
            "tanggal" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request,$rules,$customMessages);
        
        $object = new Mutabaah();

        $object->judul = $request->judul;
        $object->status = $request->status;
        $object->tanggal = $request->tanggal;
        $object->save();

        if($object){
            return back()->with(["success"=>"Berhasil Menginput Agenda Mutabaah"]);
        }

        dd($request->all());



    }
}
