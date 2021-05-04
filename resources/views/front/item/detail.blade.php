@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $("#kodeitem").val('{{ $row->kodeitem }}');
    $("#kodenelayan").val('{{ $row->kodenelayan }}');
    $("#hargaitem").val('{{ $row->hargaitem }}');

    $('.datepicker').datetimepicker({
        timepicker: false,
        format: 'Y-m-d'
    });
});

</script>

@endpush


@section('content')

<section class="py-3 bg-light" style="background:linear-gradient(0deg, rgba(0 0 0 / 30%), rgba(0 25 49)), url({{ asset('cssfront/img/banner_2.jpg') }}); background-position: center; background-size: cover;">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: white">Item</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/item') }}">Item</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $row->namaitem }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-3 bg-light mt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                {!! session('pesaninfo') !!}
            </div>
        </div>
    </div>
</section>

<form id="form1" method="post" action='{{ url("cart/actadd") }}'>
    
@csrf

<input type="hidden" id="kodeitem" name="kodeitem" />
<input type="hidden" id="kodenelayan" name="kodenelayan" />
<input type="hidden" id="hargaitem" name="hargaitem" />

<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <img class="img-fluid w-100" style="height: 350px; widht: 100%; object-fit: cover;" src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}" />
            </div>
            <div class="col-lg-6">
                <h5 style="color: orange;">{{ $row->namajenisitem }}</h5>
                <h1>{{ $row->namaitem }}</h1>
                <p class="text-muted lead">
                    Rp. {{ number_format($row->hargaitem) }} / {{ $row->satuan }} <br />
                    Stok : {{ $row->stokitem }} {{ $row->satuan }}
                </p>
                <p class="text-small mb-4">{!! $row->keteranganitem !!}</p>
                <div class="row align-items-stretch mb-4">
                    <div class="col-sm-5 pr-sm-0">
                        <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                            <div class="quantity">
                                <button type="button" class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                    <input class="form-control border-0 shadow-0 p-0" id="jumlah" name="jumlah" type="text" value="1">
                                <button type="button" class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 pl-sm-0"><button type="submit" class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" href="cart.html">Add to cart</button></div>
                </div>

                <ul class="list-unstyled small d-inline-block">
                    <li class="py-2 mb-1 bg-white"><a href='{{ url("nelayan/detail/$row->kodenelayan") }}'><strong class="text-uppercase">Nelayan :</strong><span class="ml-2 text-muted">{{ $row->namanelayan }}</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

</form>


@endsection
