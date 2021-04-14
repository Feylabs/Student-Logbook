@extends('main.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
@endsection

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kelompok</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Kelompok</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Lihat Detail Kelompok</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')
    <div class="row">

        <div class="col-md-12">
            @include('components.message')
        </div>

        <div class="col-md-12">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    @if ($widget['group'] != null)
                        <h1 class="card-title">{{ $widget['group']->nama_kelompok }}</h1>
                        <h2 class="card-title">Pembimbing : {{ $widget['group']->g_name }}</h1>
                            <h3 class="card-title">Kontak Pembimbing : {{ $widget['group']->g_contact }}</h3>
                    @endif


                    @if (Auth::guard('admin')->check())
                        <hr>
                        <h4 class="card-title">Tambah Siswa Ke Kelompok</h4>
                        <form action="{{url('group/add_group_member')}}" method="post">
                            @csrf
                            <input type="hidden" name="group_id" value="{{$widget['group']->id}}">
                            <div class="form-group">
                                <label for="">Pilih Santri Yang Akan Ditambahkan ( Pastikan Santri Tidak Terdaftar di
                                    Kelompok
                                    Lain )</label>
                                <select style="height: 500px; width:100%" class="form-control" required name="member[]"
                                    id="select-student" multiple>
                                    @foreach ($widget['santri'] as $item)
                                        <option value="{{ $item->id }}">{{ $item->kelas . '-' . $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah Siswa Ke Kelompok</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($widget['group'] != null)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Santri</th>
                                    <th>Kelas</th>
                                    <th>Asrama</th>
                                    @if (Auth::guard('admin')->check())
                                        <th>Edit</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($widget['member'] as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->asrama }}</td>
                                        @if (Auth::guard('admin')->check())
                                            <td>
                                                <form action="{{ url('group/drop_member/') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="group_id" value="{{$item->group_id}}">
                                                    <input type="hidden" name="santri_id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-danger">Hapus Siswa Dari
                                                        Kelompok</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty

                    @endforelse

                    </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@section('app-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
<script>
    $("#select-student").select2({});

</script>
@endsection
