<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SantriController extends Controller
{
    function viewAdminManage(Request $request)
    {
        $santri = Santri::all();

        $countSantri = count($santri->all());
        $countSMP = $santri->where('jenjang', '=', 'SMP')->count();
        $countSMA = $santri->where('jenjang', '=', 'SMA')->count();

        $widget = [
            "countSMP" => $countSMP,
            "countSMA" => $countSMA,
            "countSantri" => $countSantri,
        ];

        $data = Santri::select('*')
            ->orderBy('created_at', 'DESC');
        if ($request->ajax()) {
            $data = Santri::select('*')
                ->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="' . url("admin/data/santri/$row->id/edit") . '" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.santri.manage')->with(compact('widget'));
    }

    function viewAdminEdit(Request $request, $id)
    {

        $santri = Santri::find($id);
        $classes = DB::select("SELECT kelas from santris GROUP BY kelas");
        $jenjang = DB::select("SELECT jenjang from santris GROUP BY jenjang");
        $asrama = DB::select("SELECT asrama from santris GROUP BY asrama");
        $widget = [
            "santri" => $santri,
            "jenjang" => $jenjang,
            "classes" => $classes,
            "asrama" => $asrama,
        ];

        return view('admin.santri.edit')->with(compact('widget'));
    }

    function deleteAjax(Request $request)
    {
        $id = $request->id;
        $santri = Santri::findOrFail($id);
        $santri->delete();

        $santriAll= Santri::all();
        $santriSMP = $santriAll->where('jenjang','=','SMP');
        $santriSMA = $santriAll->where('jenjang','=','SMA');

        $widget = [
            "countSantri" => $santriAll->count(),
            "countSMA" => $santriSMP->count(),
            "countSMP" => $santriSMA->count(),
        ];
        return $widget;
    }


    function update(Request $request)
    {

        $rules = [
            "id" => "required",
            "nis" => "required",
            "nama" => "required",
            "kelas" => "required",
            "jenjang" => "required",
            "jk" => "required",
            "asrama" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);

        $object = Santri::find($request->id);


        $object->nis = $request->nis;
        $object->nama = $request->nama;
        $object->kelas = $request->kelas;
        $object->jenjang = $request->jenjang;
        $object->jk = $request->jk;
        $object->asrama = $request->asrama;
        $object->line_id = $request->line_id;
        $object->no_telp = $request->no_telp;

        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Mengupdate Data Santri"]);
        } else {
            return back()->with(["error" => "Gagal Mengupdate Data Santri"]);
        }
    }
}
