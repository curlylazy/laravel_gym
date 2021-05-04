@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {
    $("#katakunci").val("{{ session('search_katakunci') }}");
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
                        <li class="breadcrumb-item active" aria-current="page">Item</li>
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

<section class="py-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 order-2 order-lg-1">
                
                <form id="form1" method="post" action='{{ url("item/setkatakunci") }}'>
                    @csrf
                    <input type="text" class="form-control" id="katakunci" name="katakunci" placeholder="masukkan katakunci">
                </form>

                <div class="py-2 px-4 bg-dark text-white mb-3 mt-3"><strong class="small text-uppercase font-weight-bold">Jenis Item</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                    <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setjenisitem/all") }}'>Semua Jenis Item</a></li>
                    @foreach ($rows_jenis_item as $row)
                        @if(session('search_kodejenisitem') == $row->kodejenisitem)
                            <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setjenisitem/$row->kodejenisitem") }}'><i class="fas fa-check"></i> {{ $row->namajenisitem }}</a></li>
                        @else
                            <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setjenisitem/$row->kodejenisitem") }}'>{{ $row->namajenisitem }}</a></li>
                        @endif
                    @endforeach
                </ul>

                <div class="py-2 px-4 bg-dark text-white mb-3"><strong class="small text-uppercase font-weight-bold">Nelayan</strong></div>
                <ul class="list-unstyled small text-muted pl-lg-4 font-weight-normal">
                    <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setnelayan/all") }}'>Semua Nelayan</a></li>
                    @foreach ($rows_nelayan as $row)
                        @if(session('search_kodenelayan') == $row->kodenelayan)
                            <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setnelayan/$row->kodenelayan") }}'><i class="fas fa-check"></i> {{ $row->namanelayan }}</a></li>
                        @else
                            <li class="mb-2"><a class="reset-anchor" href='{{ url("item/setnelayan/$row->kodenelayan") }}'>{{ $row->namanelayan }}</a></li>
                        @endif
                        
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row">
                    @foreach ($rows_item as $row)
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                            <div class="product text-center">
                                <div class="position-relative mb-3">
                                    <div class="badge text-white badge-"></div>
                                    <a class="d-block" href='{{ url("item/detail/$row->kodeitem") }}'>
                                        <img class="img-fluid w-100" style="height: 150px; widht: 100%; object-fit: cover;" src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}">
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
                                <h5><a class="reset-anchor" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namaitem }}</a></h5>
                                <p class="small text-muted">
                                    Rp {{ number_format($row->hargaitem) }} / {{ $row->satuan }}<br />
                                    Stok : {{ $row->stokitem }} {{ $row->satuan }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12 mt-5">
                        {{ $rows_item->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
