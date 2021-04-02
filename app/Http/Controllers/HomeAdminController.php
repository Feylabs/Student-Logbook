<?php

namespace App\Http\Controllers;

use App\Models\Mutabaah;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeAdminController extends Controller
{
    public function index(){

        $santri = Santri::all();
        $mutabaah = Mutabaah::all();

        $asrama = DB::select("SELECT asrama , COUNT(asrama) as `count` from santri GROUP BY asrama");
        $kelas = DB::select("SELECT kelas , COUNT(kelas) as `count` from santri GROUP BY kelas ORDER BY kelas DESC");

        $countSantri = count($santri->all());
        $countSMP = $santri->where('jenjang','=','SMP')->count();
        $countSMA = $santri->where('jenjang','=','SMA')->count();
        $countAgenda = $mutabaah->where('deleted_at','=',null)->count(); 
        $widget= [
            // "santri"=>$santri,
            "countAgenda"=>$countAgenda,
            "countSantri"=>$countSantri,
            "countSMA"=>$countSMA,
            "countSMP"=>$countSMP,
            "asrama"=>$asrama,
            "kelas"=>$kelas,
        ];
        // return $widget;
        return view('admin.dashboard.home')->with(compact('widget'));
    }
}
