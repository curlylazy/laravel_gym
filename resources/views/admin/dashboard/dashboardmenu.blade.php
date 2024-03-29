@extends('admin/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

});

</script>

@endpush

@section('breadcumb')
    <ol class="breadcrumb border-0 m-0">
        {!! $breadcrumb !!}
    </ol>
@endsection


@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                   {!! $breadcrumb !!}
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jml_anggota }} <small>anggota</small></h3>
                        <p>jumlah anggota dalam sistem</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <a href="{{ url('admin/anggota/list') }}" class="small-box-footer">kelola data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jml_alat_gym }} <small>alat gym</small></h3>
                        <p>jumlah alat gym dalam sistem</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="{{ url('admin/alatgym/list') }}" class="small-box-footer">kelola data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jml_konfirmasi }} <small>konfirmasi</small></h3>
                        <p>jumlah konfirmasi perpanjangan anggota</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="{{ url('admin/alatgym/list') }}" class="small-box-footer">kelola data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $jml_kunjungan }} <small>kunjungan</small></h3>
                        <p>jumlah kunjungan per <b>{{ date('F Y') }}</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ url('admin/alatgym/list') }}" class="small-box-footer">kelola data <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kunjungan Hari Ini <b>{{ date('d F Y') }}</b></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Useranggota</th>
                                    <th>Nama</th>
                                    <td>Operator</td>
                                    <td>Tanggal</td>
                                    <td>Waktu</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows_kunjungan as $row)

                                    <tr>
                                        <td>{{ $row->kodekunjungan }}</td>
                                        <td>{{ $row->useranggota }}</td>
                                        <td>{{ $row->namaanggota }}</td>
                                        <td>{{ $row->namaadmin }}</td>
                                        <td>{{ date('d F Y', strtotime($row->dateaddkunjungan)) }}</td>
                                        @if(!empty($row->waktudatang))
                                            <td><i class="fas fa-arrow-right"></i> [Datang] {{ date('H:i:s', strtotime($row->waktudatang)) }}</td>
                                        @else
                                            <td><i class="fas fa-arrow-left"></i> [Pulang] {{ date('H:i:s', strtotime($row->waktupulang)) }}</td>
                                        @endif
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
