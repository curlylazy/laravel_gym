@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $("#kodetransaksi").val("{{ $rows->kodetransaksi }}");

    @if(session('erroract'))
        $("#kodetransaksi").val("{{ old('kodetransaksi') }}");
    @endif

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });

    $("#simpan").click(function() {

        // jika data kosong
        var konfirmasi_bank = $("#konfirmasi_bank").val();
        var konfirmasi_norek = $("#konfirmasi_norek").val();
        var konfirmasi_tanggal = $("#konfirmasi_tanggal").val();
        var konfirmasi_an = $("#konfirmasi_an").val();

        if(konfirmasi_bank == "")
        {
            Swal.fire("PERINGATAN", "nama [konfirmasi_bank] kosong", "warning");
        }
        else if(konfirmasi_norek == "")
        {
            Swal.fire("PERINGATAN", "nama [konfirmasi_norek] kosong", "warning");
        }
        else if(konfirmasi_tanggal == "")
        {
            Swal.fire("PERINGATAN", "nama [konfirmasi_tanggal] kosong", "warning");
        }
        else if(konfirmasi_an == "")
        {
            Swal.fire("PERINGATAN", "nama [konfirmasi_an] kosong", "warning");
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

<!-- Page Header -->
<section class="py-3 bg-light" style="background:linear-gradient(0deg, rgba(0 0 0 / 30%), rgba(0 25 49)), url({{ asset('cssfront/img/banner_2.jpg') }}); background-position: center; background-size: cover;">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: white">Konfirmasi</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/transaksi') }}">Transaksi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Konfirmasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-3 bg-light mt-2">
    <div class="container">

        @if(!empty(session('pesaninfo')))
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        @endif

        <div class="row">

            <div class="col-12">
                <p>
                    Silahkan melakukan transaksi pembayaran anda di <b>{{ $rows->namanelayan }}</b>, dengan rekening tujuan <br />
                    Bank : <b>{{ $rows->rek_banknelayan }}</b><br />
                    No Rekening : <b>{{ $rows->rek_noreknelayan }}</b><br />
                    A.N : <b>{{ $rows->rek_annelayan }}</b><hr />
                    
                    @if($rows->pengiriman_mode == 'DIKIRIM')
                        Biaya Pengiriman : <b>{{ number_format($rows->pengiriman_biaya) }}</b><br />
                    @endif
                    Total Yang Harus Dibayar : <b>{{ number_format($rows->totaltransaksi) }}</b>
                    <hr />
                </p>
            </div>

            <div class="col-lg-12">
                <form id="form1" enctype="multipart/form-data" method="post" action='{{ url("transaksi/actkonfirmasi") }}' autocomplete="off">

                    @csrf

                    <input type="hidden" name="kodetransaksi" id="kodetransaksi">

                    <div class="row">
                        <div class="col">
                            <label for="konfirmasi_bank">Konfirmasi Bank</label>
                            <select type="text" class="form-control" id="konfirmasi_bank" name="konfirmasi_bank">
                                <option value="">Pilih Bank Anda</option>
                                <option value="BNI">BNI</option>
                                <option value="BRI">BRI</option>
                                <option value="BCA">BCA</option>
                                <option value="BPD BALI">BPD BALI</option>
                                <option value="CIMB NIAGA">CIMB NIAGA</option>
                                <option value="BANK PERMATA">BANK PERMATA</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="konfirmasi_norek">Konfirmasi No Rekening</label>
                            <input type="text" class="form-control" id="konfirmasi_norek" name="konfirmasi_norek" placeholder="masukkan no rekening anda..">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="konfirmasi_an">Atas Nama Rekening</label>
                            <input type="text" class="form-control" id="konfirmasi_an" name="konfirmasi_an" placeholder="masukkan atas nama rekening..">
                        </div>
                        <div class="col">
                            <label for="konfirmasi_tanggal">Tanggal</label>
                            <input type="text" class="form-control datepicker" id="konfirmasi_tanggal" name="konfirmasi_tanggal" placeholder="masukkan tanggal konfirmasi anda..">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label>Photo</label>
                        <input type="file" id="konfirmasi_bukti" name="konfirmasi_bukti" class="form-control"><br />
                        <img src="" id="gambarview" style="width: 200px; border-radius: 10px;">
                    </div>

                    <button type="button" id="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
