@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Mutaba'ah</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Mutaba'ah</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Buat Agenda Mutaba'ah</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                    <option selected>Aug 19</option>
                    <option value="1">July 19</option>
                    <option value="2">Jun 19</option>
                </select>
            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-md-12">
            @include('components.message')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Default Ordering</h4>
                    <h6 class="card-subtitle">With DataTables you can alter the ordering characteristics of
                        the table at initialisation time. Using the<code> order | option</code> order
                        initialisation parameter, you can set the table to display the data in exactly the
                        order that you want.</h6>
                    <div class="table-responsive">
                        <table id="table_mutabaah" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Dibuat Oleh</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




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
        $(function() {
            var table = $('#table_mutabaah').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lrtipB',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                ajax: {
                    type: "POST",
                    url: "{{ url('admin/data/mutabaah/manage') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    async: true,
                    error: function(xhr, error, code) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'judul',
                        name: 'judul'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'created_byz',
                        name: 'created_byz',
                        orderable: true,
                        searchable: true
                    },
                    {
                        render: function(datum, type, row) {
                            console.log(row.status);
                            let html = "";
                            switch (row.status) {
                                case 1:
                                    html = '<h5 class="badge badge-success">' + 'Dibuka' + '</h5>';
                                    break;
                                case 0:
                                    html = '<h5 class="badge badge-warning">' + 'Ditutup' + '</h5>';
                                    break;
                                case 3:
                                    html = '<h5 class="badge badge-pending">' + 'Pending' + '</h5>';
                                    break;
                                default:
                                    html = '<h5 class="badge badge-primary">' + 'Tidak Diketahui' + '</h5>';
                                    break;
                            }
                            return html  ;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });
        });

    </script>


@endsection
