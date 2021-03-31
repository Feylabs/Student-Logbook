<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Mutabaah;
use Illuminate\Http\Request;

class SantriMutabaahController extends Controller
{
    function viewSantriInit()
    {

        $mutabaah = Mutabaah::all()->sortByDesc('tanggal');

        $widget = [
            "mutabaah"=>$mutabaah,
        ];
        return view('santri.mutabaah.init')->with(compact(['widget']));
    }

    function input($id){
        $mutabaah = Mutabaah::all()->sortByDesc('tanggal');
        $mutabaahCurrent = Mutabaah::where('id','=',$id)->first();
        $activity = Activity::where('mutabaah_id','=',$id)->get();
        
        if ($mutabaahCurrent->status !=1) {
            return back()->with(["error"=>"Lembar Mutaba'ah Ini Sudah Ditutup"]);
        }else{
            
            $widget=[
                "mutabaah" => $mutabaah,
                "mutabaahCurrent" => $mutabaahCurrent,
                "activity" => $activity,
            ];

            return view('santri.mutabaah.input')->with(compact('widget'));
        }

    }

    function store(Request $request , $id){
        return $request->all();
    }
}
