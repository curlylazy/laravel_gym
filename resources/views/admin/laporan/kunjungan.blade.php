@extends('admin/template')

@push('scripts')
<script type="text/javascript">

$(document).ready(function() {

    $("#katakunci").val("{{ $katakunci }}");
    $("#tanggaldari").val("{{ $tanggaldari }}");
    $("#tanggalsampai").val("{{ $tanggalsampai }}");

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

    $("#cari").click(function() {
        $("#form1").attr("action", "{{ url('admin/laporan/kunjungan') }}");
        $("#form1").submit();
    });

    $("#cetak").click(function() {
        $("#form1").attr("action", "{{ url('admin/laporan/cetak/kunjungan') }}");
        $("#form1").submit();
    });
});

</script>
@endpush

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark" style="letter-spacing: 2px;">{{ $pagename }}</h4>
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

        <!-- cek apakah informasi -->
        @if (session('pesaninfo'))
            <div class="row">
                <div class="col-12 col-md-12">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        @endif

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="form1" enctype="multipart/form-data" method="post" id="form1">
                            
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Katakunci</label>
                                    <input type="text" class="form-control" name="katakunci" id="katakunci">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Tanggal Dari</label>
                                    <input type="text" class="form-control datepicker" name="tanggaldari" id="tanggaldari">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>s/d</label>
                                    <input type="text" class="form-control datepicker" name="tanggalsampai" id="tanggalsampai">
                                </div>
                            </div>

                            <button class="btn btn-warning" type="button" id="cari"><i class="fa fa-search"></i> CARI</button>
                            <button class="btn btn-info" type="button" id="cetak"><i class="fa fa-print"></i> CETAK</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
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
                                @foreach ($rows as $row)

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
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("nelayan/dashboard") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
