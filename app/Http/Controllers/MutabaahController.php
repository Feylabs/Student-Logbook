<?php

namespace App\Http\Controllers;

use App\Models\Mutabaah;
use App\Models\Santri;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MutabaahController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Santri::select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="row"><a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            dd($request->all());
        }

        return view('admin.user.index');
    }

    public function testEloquent()
    {
        $data = Mutabaah::find(1);
        return $data->admin;
        return compact('data');
    }

    function viewAdminCreate()
    {
        return view('admin.mutabaah.create');
    }

    function viewAdminManage(Request $request)
    {
        $data = Mutabaah::select('*')->orderBy('created_at', 'DESC');
        if ($request->ajax()) {
            $data = Mutabaah::select('*')->orderBy('created_at', 'DESC');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="d-flex"><a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-primary btn-sm ml-2 btn-edit">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger btn-sm ml-2 btn-delete">Delete</a></div>';
                    return $btn;
                })
                ->addColumn('created_byz', function ($row) {

                    return $row->admin->name;
                })
                ->rawColumns(['action','created_byz'])
                ->make(true);
            dd($request->all());
        }

        return view('admin.mutabaah.manage');
    }

    function store(Request $request)
    {
        $rules = [
            "user_id" => "required",
            "judul" => "required",
            "status" => "required",
            "tanggal" => "required",
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $object = new Mutabaah();

        $object->judul = $request->judul;
        $object->status = $request->status;
        $object->tanggal = $request->tanggal;
        $object->created_by = $request->user_id;
        $object->save();

        if ($object) {
            return back()->with(["success" => "Berhasil Menginput Agenda Mutabaah"]);
        }

        dd($request->all());
    }
}
