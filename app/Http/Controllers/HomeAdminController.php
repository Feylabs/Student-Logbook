<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    public function index(){

        $santri = Santri::all();

        $countSantri = count($santri->all());
        $countSMP = $santri->where('jenjang','=','SMP')->count();
        $countSMA = $santri->where('jenjang','=','SMA')->count();
        $widget= [
            "santri"=>$santri,
            "countSantri"=>$countSantri,
            "countSMA"=>$countSMA,
            "countSMP"=>$countSMP,
        ];
        return view('admin.dashboard.home')->with(compact('widget'));
    }
}
