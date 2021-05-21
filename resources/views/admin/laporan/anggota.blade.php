@extends('admin/template')

@push('scripts')
<script type="text/javascript">

$(document).ready(function() {
    $("#katakunci").val("{{ $katakunci }}");

    $("#cari").click(function() {
        $("#form1").attr("action", "{{ url('admin/laporan/anggota') }}");
        $("#form1").submit();
    });

    $("#cetak").click(function() {
        $("#form1").attr("action", "{{ url('admin/laporan/cetak/anggota') }}");
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

                            <div class="form-group">
                                <label for="konfirmasi_status">Katakunci</label>
                                <input type="text" class="form-control" name="katakunci" id="katakunci">
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
                                    <th>JK</th>
                                    <th>Telepon</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)

                                    <tr>
                                        <td>{{ $row->kodeanggota }}</td>
                                        <td>{{ $row->useranggota }}</td>
                                        <td>{{ $row->namaanggota }}</td>
                                        <td>{{ $row->jk }}</td>
                                        <td>{{ $row->noteleponanggota }}</td>
                                        <td>{{ $row->alamatanggota }}</td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/dashboard") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
