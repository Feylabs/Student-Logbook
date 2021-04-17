<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Admin;
use App\Models\Mutabaah;
use App\Models\Santri;
use App\Models\SantriMutabaahRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportMutabaahController extends Controller
{
    function viewAdminManage(Request $request)
    {

        $data = Mutabaah::select('*')
            ->whereColumn('deleted_at', '=', null)
            ->orderBy('created_at', 'DESC');
        if ($request->ajax()) {
            $data = Mutabaah::select('*')
                ->where('deleted_at', '=', null)
                ->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';
                    return $btn;
                })
                ->addColumn('created_byz', function ($row) {
                    $mutabaah = Mutabaah::where('id', '=', $row->id)->get();
                    $admin = Admin::where('id', '=', $row->created_by)->first();
                    $name = $admin->name;
                    return $name;
                })
                ->rawColumns(['action', 'created_byz'])
                ->make(true);
            dd($request->all());
        }

        return view('admin.mutabaah.manage');
    }

    function viewCheck(Request $request)
    {
        $agenda_id = $request->agenda_id;
        $class_id = $request->class_id;

        $class_current = "all";


        $activities = Activity::where('mutabaah_id', '=', $agenda_id)->get();

        $recordFT = array();
        $santriFT = array();
        $razkun = array();

        $razky = DB::select("SELECT `santri_id` FROM `santri_mutabaah_records` WHERE `mutabaah_id`='$agenda_id' GROUP BY `santri_id` ");
        $counter = 0;

        $recordForCheck = SantriMutabaahRecord::where('mutabaah_id', '=', $agenda_id);

        $santriNotFill = DB::table('santri')
            ->select(
                'santri.id',
                'santri.nama',
                'santri.kelas',
                'santri.asrama',
                'santri.nis',
            )

            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('santri_mutabaah_records')
                    ->whereRaw('santri.id = santri_mutabaah_records.santri_id');
            })->get();



        foreach ($razky as $key) {
            $counter++;

            $record =
                SantriMutabaahRecord::where('mutabaah_id', '=', $agenda_id)
                ->where('santri_id', '=', $key->santri_id)
                ->get();

            $santri = Santri::where('id', '=', $key->santri_id)->first();
            if ($santri==null) { 
            continue;
            }

            $class_current = $class_id;


            if ($class_id != null  && $class_id != "") {

                $santriNotFill = DB::table('santri')
                    ->select(
                        'santri.id',
                        'santri.nama',
                        'santri.kelas',
                        'santri.asrama',
                        'santri.nis',
                    )->where("kelas",'=',$class_current)

                    ->whereNotExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('santri_mutabaah_records')
                            ->whereRaw('santri.id = santri_mutabaah_records.santri_id');
                    })->get();


                if ($santri->kelas == $class_id) {
                    $razkun[] = [
                        "santri_id" => $key->santri_id,
                        "santri_nis" => $santri->nis,
                        "santri_name" => $santri->nama,
                        "santri_kelas" => $santri->kelas,
                        "santri_asrama" => $santri->asrama,
                        "record" => $record,
                    ];
                } else {
                    continue;
                }
            } else {

                $razkun[] = [
                    "santri_id" => $key->santri_id,
                    "santri_nis" => $santri->nis,
                    "santri_name" => $santri->nama,
                    "santri_kelas" => $santri->kelas,
                    "santri_asrama" => $santri->asrama,
                    "record" => $record,
                ];
            }
        }


        $santris = Santri::all();
        $classes = DB::select("SELECT kelas from santri GROUP BY kelas");
        $jenjang = DB::select("SELECT jenjang from santri GROUP BY jenjang");
        $asrama = DB::select("SELECT asrama from santri GROUP BY asrama");

        $mutabaah = Mutabaah::where('deleted_at','=',null)->get();
        $currentMutabaah = Mutabaah::where('id', '=', $agenda_id)->first();

        if ($currentMutabaah == null) {
            $santriNotFill=array();
        }

        $widget = [
            "classCurrent" => $class_current,
            "classes" => $classes,
            "santriNotFill" => $santriNotFill,
            "asrama" => $asrama,
            "recordSantri" => $razkun,
            "mutabaah" => $mutabaah,
            "currentMutabaah" => $currentMutabaah,
            "activities" => $activities,
        ];
        
    

        // return $widget;
        // return $widget['recordSantri'];
        return view('mutabaah.report.index')->with(compact('widget'));
    }
}
