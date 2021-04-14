@extends('main.app')

@section('style')
    <style>
        /**
                 * Simple HTML/CSS switch
                 */
        .componentsBox .content {
            margin-bottom: 20px;
        }

        .m5 {
            margin: 0 5px;
        }

        .switch {
            display: inline-block;
        }

        .switch input {
            display: none;
        }

        .switch small {
            display: inline-block;
            width: 53px;
            height: 29px;
            background: #455a64;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
        }

        .switch small:after {
            content: "Tidak";
            position: absolute;
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            width: 100%;
            left: 0px;
            text-align: right;
            padding: 0 6px;
            box-sizing: border-box;
            line-height: 28px;
        }

        .switch small:before {
            content: "";
            position: absolute;
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            top: 6px;
            left: 3px;
            transition: .3s;
            box-shadow: -3px 0 3px rgba(0, 0, 0, 0.1);
        }

        .switch input:checked~small {
            background: #4fc5c5;
            transition: .3s;
        }

        .switch input:checked~small:before {
            transform: translate(35px, 0px);
            transition: .3s;
        }

        .switch input:checked~small:after {
            content: "Ya";
            text-align: left;
        }

        .switchSmall {
            display: inline-block;
        }

    </style>
@endsection

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Mutaba'ah Yaumiyah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Mutaba'ah</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Input</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">{{ $widget['mutabaahCurrent']->judul }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">

        </div>
    </div>
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-md-12">
            @include('components.message')
        </div>
    </div>

    <form id="formMutabaah" class="row" action="{{ route('santri.mutabaah.store', $widget['mutabaahCurrent']->id) }}"
        method="post">
        @csrf
        <input type="hidden" name="santri_id" value="{{ Auth::guard('santri')->user()->id }}">
        <input type="hidden" name="mutabaah_id" value="{{ $widget['mutabaahCurrent']->id }}">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-dark">Pengisian Lembar Mutaba'ah</h2>
                            <h4>Nama Lembar Mutaba'ah : {{ $widget['mutabaahCurrent']->judul }} <br>
                                Tanggal Lembar Mutaba'ah : {{ $widget['mutabaahCurrent']->tanggal }} <br></p>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="table_data" class="table table-striped table-bordered no-wrap w-100 ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($widget['activity'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_kegiatan }} <br>
                                            <label class="switch m5" for="toggle_{{ $loop->iteration }}">
                                            <input type="hidden" name="activity[{{ $item->id }}]" value="0" />
                                                <input name="activity[{{ $item->id }}]"
                                                    id="toggle_{{ $loop->iteration }}" type="checkbox">
                                                <small></small>
                                            </label>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>

                        <button type="button" onclick="sure()" class="btn btn-block btn-outline-primary">Kirim Lembar
                            Mutaba'ah</button>

                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection


@section('app-script')
<script type="text/javascript"
    src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
</script>

<script type="text/javascript">
    let sure = () => {
        swal({
                title: "Antum Yakin Akan Mengumpulkan Lembar Mutaba'ah?",
                text: "Lembar Yang Sudah Dikumpulkan Tidak Dapat Diubah",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Ya Kirimkan",
                cancelButtonText: "Cek Ulang",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {
                    $("#formMutabaah").submit();
                    swal("Lembar Mutabaah Akan Diinput ke Database", "", "success");
                } else {
                    swal("Cancelled", "S :)", "");
                }
            });

    }
    $(function() {


        $('body').on("click", ".btn-delete", function() {
            var id = $(this).attr("id")
            $(".btn-destroy").attr("id", id)
            $("#destroy-modal").modal("show")
        });


        // Edit & Update
        $('body').on("click", ".btn-edit", function() {
            var id = $(this).attr("id")
            $.ajax({
                url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                method: "GET",
                success: function(response) {
                    $("#edit-modal").modal("show")
                    console.log(response)
                    $("#id").val(response.id)
                    $("#name").val(response.judul)
                    $("#edit_date").val(response.tanggal)
                    $("#role").val(response.role)
                }
            })
        });

    });

</script>




@endsection
