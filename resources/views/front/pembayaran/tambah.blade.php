@extends('front/template')

@push('scripts')

<script type="text/javascript">

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).ready(function() {

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

    @if($aksi == "actedit")

        @php
            $statuskonfirmasi = $rows->statuskonfirmasi;
        @endphp

        $("#kodekonfirmasi").val("{{ $rows->kodekonfirmasi }}");
        $("#norek").val("{{ $rows->norek }}");
        $("#bank").val("{{ $rows->bank }}");
        $("#an").val("{{ $rows->an }}");
        $("#tanggalkonfirmasi").val("{{ $rows->tanggalkonfirmasi }}");
        $("#gambarview").attr("src", '{{ url("gambar/$rows->gambarbukti") }}');
    @else

        @php
            $statuskonfirmasi = "";
        @endphp

        $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");
    @endif

    
    @if(session('erroract'))
        $("#kodekonfirmasi").val("{{ old('kodekonfirmasi') }}");
        $("#norek").val("{{ old('norek') }}");
        $("#bank").val("{{ old('bank') }}");
        $("#an").val("{{ old('an') }}");
    @endif

    $("#simpan").click(function() {

        if($("#norek").val() == "")
        {
            Swal.fire("PERINGATAN", "[norek] kosong", "warning");
        }
        else if($("#bank").val() == "")
        {
            Swal.fire("PERINGATAN", "[bank] kosong", "warning");
        }
        else if($("#an").val() == "")
        {
            Swal.fire("PERINGATAN", "[an] kosong", "warning");
        }
        else
        {
            $("#form1").submit();
        }
    });
});

</script>

@endpush


@section('content')

<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{ asset('cssfront/images/img_bg_3.jpg') }}); height: 200px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center" style="margin-top: 50px;">
                <h1 style="color: white;">PEMBAYARAN</h1>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-contact">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                @if(!empty(session('pesaninfo')))
                    {!! session('pesaninfo') !!}
                @endif
            </div>
            <div class="col-lg-12 mx-auto">
                <p>
                    Jika masa berlaku keanggotaan anda sudah lewat, maka tanggal aktif dihitung mulai dari tanggal konfirmasi.<br />
                    Silahkan melakukan transfer pembayaran ke rekening Tiger Gym, <br />
                    <b>BRI 029388477384 A.N : Tiger Gym</b>
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 animate-box">
                <form enctype="multipart/form-data" action='{{ url("pembayaran/$aksi") }}' id="form1" method="post">

                    @csrf

                    <input type="text" class="form-control hidden" id="kodekonfirmasi" name="kodekonfirmasi">

                    <div class="row form-group">
                        <div class="col-md-4">
                            <label for="bank">Bank</label>
                            <select type="text" class="form-control" id="bank" name="bank" placeholder="masukkan bank anda">
                                <option value="">Pilih bank anda</option>
                                <option value="BCA">BCA</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="BTN">BTN</option>
                                <option value="BPD">BPD</option>
                                <option value="CIMB">CIMB</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="norek">No Rek</label>
                            <input type="text" class="form-control" id="norek" name="norek" placeholder="masukkan no rekening anda">
                        </div>
                        <div class="col-md-4">
                            <label for="an">A.N</label>
                            <input type="text" class="form-control" id="an" name="an" placeholder="masukan nama pemilik rekening">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="tanggalkonfirmasi">Tanggal Konfirmasi</label>
                            <input type="text" class="form-control datepicker" id="tanggalkonfirmasi" name="tanggalkonfirmasi" placeholder="masukkan tanggal konfirmasi">
                        </div>
                    </div>

                    @if(!empty($statuskonfirmasi))
                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="statuskonfirmasi">Status Konfirmasi</label>
                                <p>{{ App\Lib\Cview::StatusKonfirmasi($statuskonfirmasi) }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="gambarbukti">Bukti Transfer</label>
                            <input type="file" class="form-control" id="gambarbukti" name="gambarbukti">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <img id="gambarview" style="width: 250px;" />
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="simpan" class="btn btn-primary">SIMPAN</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection
