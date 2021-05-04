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
                <h1 class="h2 text-uppercase mb-0" style="color: white">Nelayan</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nelayan</li>
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

            <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row">
                    
                    @foreach ($rows_nelayan as $row)
                        <div class="col-md-4 col-6 mb-4">
                            <div class="product text-center">
                                <div class="position-relative mb-3">
                                    <div class="badge text-white badge-"></div>
                                    <a class="d-block" href='{{ url("item/detail/$row->kodenelayan") }}'>
                                        <img class="img-fluid w-100" style="height: 200px; widht: 100%; object-fit: cover;" src='{{ url("gambar/$row->gambarnelayan") }}' alt="{{ $row->namanelayan }}">
                                    </a>
                                    <div class="product-overlay">
                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item m-0 p-0"><a href='{{ url("nelayan/detail/$row->kodenelayan") }}' class="btn btn-sm btn-dark">Detail Nelayan</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <h7 style="font-size: 11pt;"><i class="fas fa-user-tag"></i> <a class="reset-anchor" href='{{ url("nelayan/detail/$row->kodenelayan") }}'>{{ $row->namanelayan }}</a></h7>
                                <h5><a class="reset-anchor" href='{{ url("nelayan/detail/$row->kodenelayan") }}'>{{ $row->namanelayan }}</a></h5>
                                <p class="small text-muted">
                                    
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12 mt-5">
                        {{ $rows_nelayan->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
