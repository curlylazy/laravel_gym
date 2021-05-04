@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {
    
});

</script>

@endpush


@push('stylecss')

@endpush


@section('content')

<div class="container">
    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background:linear-gradient(0deg, rgba(255 255 255 / 30%), rgba(255 255 255 / 0%)), url({{ asset('cssfront/img/banner.jpg') }})">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Berbagai Macam Hasil Laut</p>
                    <h1 class="h2 text-uppercase mb-3">E-Commerce Pasar Ikan Pengambengan</h1>
                    <a class="btn btn-dark" href="{{ url('/toko') }}">Telusuri Toko</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light mt-3" style="background-color: #d4d4d4 !important;">
        <div class="container">
            <div class="row text-center">

                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <i class="fas fa-shopping-cart fa-3x"></i>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">Pesan Online</h6>
                                <p class="text-small mb-0 text-muted">cek harga dan pesan dari rumah</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <i class="fas fa-store-alt fa-3x"></i>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">Banyak Toko</h6>
                                <p class="text-small mb-0 text-muted">cek harga dari berbagai macam toko</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="d-inline-block">
                        <div class="media align-items-end">
                            <i class="fas fa-fish fa-3x"></i>
                            <div class="media-body text-left ml-3">
                                <h6 class="text-uppercase mb-1">Beragam Ikan</h6>
                                <p class="text-small mb-0 text-muted">banyak hasil laut dengan harga terjangkau</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5">
        <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Banyak Toko & Banyak Item</p>
            <h2 class="h5 text-uppercase mb-4">cek harga ikan semua toko, dan berbagai macam jenis ikan.</h2>
        </header>
    </section>

    <section class="py-5">
        <div class="row">

            @foreach ($rows_item as $row)
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div>
                            <a class="d-block" href='{{ url("item/detail/$row->kodeitem") }}'>
                                <img class="img-fluid w-100" style="height: 250px; widht: 100%; object-fit: cover;" src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}">
                            </a>
                            <div class="product-overlay">
                                <ul class="mb-0 list-inline">
                                    @if($row->stokitem > 0)
                                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" onclick='return confirm("tambahkan item ke cart ?.")' href='{{ url("cart/actaddget/$row->kodeitem") }}'>Add to cart</a></li>
                                    @else
                                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-danger" href='#'>Stok Habis</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <h7 style="font-size: 11pt;"><i class="fas fa-user-tag"></i> <a class="reset-anchor" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namanelayan }}</a></h7>
                        <h4><a class="reset-anchor" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namaitem }}</a></h4>
                        <p class="small text-muted">
                            Rp {{ number_format($row->hargaitem) }}<br />
                            Stok : {{ $row->stokitem }} / {{ $row->satuan }}
                        </p>
                    </div>
                </div>
            @endforeach
            
        </div>
    </section>

</div>

@endsection

