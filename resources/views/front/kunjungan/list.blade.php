@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

    $("#tanggaldari").val("{{ $tanggaldari }}");
    $("#tanggalsampai").val("{{ $tanggalsampai }}");
});

</script>

@endpush


@section('content')

<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{ asset('cssfront/images/img_bg_3.jpg') }}); height: 200px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center" style="margin-top: 50px;">
                <h1 style="color: white;">KUNJUNGAN</h1>
                <p style="color: white;">history kunjungan anda ke TIGER GYM.</p>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-blog" class="fh5co-bg-section">
    <div class="container">

        <div class="row row-bottom-padded-md">
            <form enctype="multipart/form-data" action='{{ url("$prefix/actsetfilter") }}' id="form1" method="post">

                @csrf

                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="tanggaldari">Tanggal Dari</label>
                        <input type="text" class="form-control datepicker" id="tanggaldari" name="tanggaldari" placeholder="masukkan tanggal dari..">
                    </div>
                    <div class="col-md-6">
                        <label for="tanggalsampai">Tanggal Sampai</label>
                        <input type="text" class="form-control datepicker" id="tanggalsampai" name="tanggalsampai" placeholder="masukkan tanggal sampai">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" id="cari" class="btn btn-primary"><i class="fas fa-search"></i> CARI</button>
                </div>
            </form>

            <div class="row animate-box">
                @if(count($rows) == 0)
                    <div class="col-12">
                        <p class="text-center">data tidak ditemukan</p>
                    </div>
                @endif
            </div>

            @if(count($rows) > 0)
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td>Kode Kunjungan</td>
                            <td>Operator</td>
                            <td>Tanggal</td>
                            <td>Waktu</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row->kodekunjungan }}</td>
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
            @endif

            {{ $rows->links() }}
            
        </div>
    </div>
</div>

@endsection
