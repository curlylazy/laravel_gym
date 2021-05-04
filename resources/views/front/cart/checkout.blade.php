@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $("#test").click(function() {
        $.ajax({
            url: "{{ url('ajax/pengiriman/getongkir') }}",
            type: "POST",
            async: false,
            cache: false,
            data:{
                _token:'{{ csrf_token() }}',
                pengiriman_kabupaten: $("#pengiriman_kabupaten").val(),
            },
            success: function(dataResult){

                var row = JSON.parse(dataResult);
                if(row.statusCode == 200)
                {
                    alert("statuscode 200;");
                }

                alert(dataResult);
            }
        });
    });

    $("#simpan").click(function() {

        var pengiriman_mode = $("#pengiriman_mode").val();
        var pengiriman_alamat = $("#pengiriman_alamat").val();
        var pengiriman_kabupaten = $("#pengiriman_kabupaten").val();

        if(pengiriman_mode == "")
        {
            Swal.fire("PERINGATAN", "nama [pengiriman_mode] kosong", "warning");
            return;
        }

        if(pengiriman_mode == "DIKIRIM")
        {
            if(pengiriman_alamat == "")
            {
                Swal.fire("PERINGATAN", "nama [pengiriman_alamat] kosong", "warning");
                return;
            }

            if(pengiriman_kabupaten == "")
            {
                Swal.fire("PERINGATAN", "nama [pengiriman_kabupaten] kosong", "warning");
                return;
            }
        }

        var isconfirm = confirm('apakah anda akan melakukan checkout pemesanan ?');
        if(isconfirm)
        {
            $("#form1").submit();
        }

    });

    $("#pengiriman_mode").change(function() {
        if(this.value == "DIKIRIM")
        {
            $("#panel_pengiriman").removeClass("hidden");
        }
        else
        {
            $("#panel_pengiriman").addClass("hidden");
        }
    });

});

</script>

@endpush


@section('content')

<section class="py-3 bg-light" style="background:linear-gradient(0deg, rgba(0 0 0 / 30%), rgba(0 25 49)), url({{ asset('cssfront/img/banner_2.jpg') }}); background-position: center; background-size: cover;">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: white">Checkout</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" style="color: white"><a href="{{ url('/cart') }}">Cart</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<div class="container">

    <section class="py-3 bg-light mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Info Check Out</h2>
        <p style="font-weight: bold; font-size: 9pt;">NB : barang yang sudah diambil atau dikirim tidak bisa dikembalikan lagi.</p>
        <p>Anda melakukan transaksi pembelian di <b>{{ $jmltokoincart }}</b> toko, harap melakukan konfirmasi pembayaran ke masing masing toko.</p>
        <hr />
        <div class="row">
            @foreach ($rows_toko as $row)
                <div class="col-12 mb-4">
                    <div class="media">
                        <img class="mr-3" style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;" src='{{ url("gambar/$row->gambarnelayan") }}' alt="Generic placeholder image">
                        <div class="media-body">
                            <h5 class="mt-0">{{ $row->namanelayan }}</h5>
                            <p style="margin-bottom: 0px;">Daftar Belanja : </p>
                            <p style="font-size: 10pt;">{!! $row->items !!}</p>
                            <p>Total Transaksi : {{ number_format($row->totaltransaksi) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-lg-12">

                <form id="form1" method="post" enctype="multipart/form-data" action='{{ url("cart/actcheckout") }}'>
                
                @csrf
                
                <div class="form-group mt-3">
                    <label for="pengiriman_mode">Pengiriman Mode</label>
                    <select type="text" class="form-control" id="pengiriman_mode" name="pengiriman_mode">
                        <option value="">-- Pilih Mode Pengiriman --</option>
                        <option value="DIKIRIM">Dikirim Oleh Nelayan</option>
                        <option value="DIAMBIL">Anda Ambil Ke Lokasi</option>
                    </select>
                </div>

                <div id="panel_pengiriman" class="hidden">
                    <div class="row mb-2">
                        <div class="col">
                            <label for="pengiriman_kabupaten">Kabupaten</label>
                            <select type="text" class="form-control" id="pengiriman_kabupaten" name="pengiriman_kabupaten">
                                {!! App\Lib\Cview::tampilDropDownKabupaten() !!}
                            </select>
                        </div>
                        <div class="col">
                            <label for="pengiriman_alamat">Alamat Pengiriman</label>
                            <input type="text" class="form-control" id="pengiriman_alamat" name="pengiriman_alamat" placeholder="masukkan alamat tujuan pengiriman">
                        </div>
                    </div>

                    <p>Untuk pengiriman dikenakan biaya <b>Rp 50.000</b> untuk setiap nelayan.</p>
                </div>

                <a class="btn btn-dark btn-sm" href='{{ url("cart") }}'> <i class="fas fa-backward mr-2"></i>Kembali</a>
                <button type="button" id="simpan" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Submit</button>
                <button type="button" id="test" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Test</button>

                </form>
            </div>
        </div>

    </section>

</div>



@endsection
