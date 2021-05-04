@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

});

</script>

@endpush


@section('content')

<section class="py-3 bg-light" style="background:linear-gradient(0deg, rgba(0 0 0 / 30%), rgba(0 25 49)), url({{ asset('cssfront/img/banner_2.jpg') }}); background-position: center; background-size: cover;">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: white">Nelayan</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/nelayan') }}">Nelayan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $row->namanelayan }}</li>
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
        <div class="row mb-5">
            <div class="col-lg-3">
                <img class="img-fluid w-100" style="height: 200px; widht: 100%; object-fit: cover; border-radius: 20px" src='{{ url("gambar/$row->gambarnelayan") }}' alt="{{ $row->namanelayan }}" />
            </div>
            <div class="col-lg-9">
                <h1 style="letter-spacing: 5px;">{{ $row->namanelayan }}</h1>
                <p class="text-muted lead">
                    {{ $row->emailnelayan }}<br />
                    {{ $row->noteleponnelayan }}
                </p>

                <p class="text-muted lead">
                    {{ $row->keterangannelayan }}
                </p>

                <hr />
            </div>
        </div>

        <div class="row">
            @foreach ($rows_item as $row)
                <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                    <div class="product text-center">
                        <div class="position-relative mb-3">
                            <div class="badge text-white badge-"></div>
                            <a class="d-block" href='{{ url("item/detail/$row->kodeitem") }}'>
                                <img class="img-fluid w-100" style="height: 200px; widht: 100%; border-radius: 5px; object-fit: cover;" src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}">
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
                        <h5><a class="reset-anchor" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namaitem }}</a></h5>
                        <p class="small text-muted">
                            Rp {{ number_format($row->hargaitem) }} / {{ $row->satuan }}<br />
                            Stok : {{ $row->stokitem }} {{ $row->satuan }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
