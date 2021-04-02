<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Mutabaah;
use App\Models\Santri;
use App\Models\SantriMutabaahRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportMutabaahController extends Controller
{
    function viewCheck(Request $request)
    {
        $agenda_id = $request->agenda_id;
        $class_id = $request->class_id;


        $activities = Activity::where('mutabaah_id', '=', $agenda_id)->get();

        $recordFT = array();
        $santriFT = array();
        $razkun = array();

        $razky = DB::select("SELECT `santri_id` 
        FROM 
        `santri_mutabaah_records` 
        WHERE 
        `mutabaah_id`='$agenda_id' 
        GROUP BY `santri_id` ");


        $counter = 0;
        foreach ($razky as $key) {
            $counter++;


            $record =
                SantriMutabaahRecord::where('mutabaah_id', '=', $agenda_id)
                ->where('santri_id', '=', $key->santri_id)
                ->get();

            $santri = Santri::where('id', '=', $key->santri_id)->first();

            // if ($class_id != null  && $class_id != "") {
            //     $santri = Santri::where('id', '=', $key->santri_id)
            //     ->where('kelas','=',$class_id)
            //     ->first();
            // }

            $razkun[] = [
                "santri_id" => $key->santri_id,
                "santri_nis" => $santri->nis,
                "santri_name" => $santri->nama,
                "santri_kelas" => $santri->kelas,
                "santri_asrama" => $santri->asrama,
                "record" => $record,
            ];
        }

        // if () {
        //     # code...
        // }



        $santris = Santri::all();
        $classes = DB::select("SELECT kelas from santri GROUP BY kelas");
        $jenjang = DB::select("SELECT jenjang from santri GROUP BY jenjang");
        $asrama = DB::select("SELECT asrama from santri GROUP BY asrama");

        $mutabaah = Mutabaah::all();
        $currentMutabaah = Mutabaah::where('id', '=', $agenda_id)->first();

        $widget = [
            "classes" => $classes,
            "asrama" => $asrama,
            "recordSantri" => $razkun,
            "mutabaah" => $mutabaah,
            "currentMutabaah" => $currentMutabaah,
            "activities" => $activities,
        ];

        // return $widget;
        // return $widget['recordSantri'];
        return view('admin.mutabaah.report.index')->with(compact('widget'));
    }
}
