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
                <h1 class="h2 text-uppercase mb-0" style="color: white">Transaksi</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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

                    @if(count($rows_transaksi) == 0)
                        <div class="col-12 mb-3">
                            <p class="text-center">Belum ada transaksi</p>
                        </div>
                    @endif

                    @foreach ($rows_transaksi as $row)
                       <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->kodetransaksi }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $row->namanelayan }}</h6>
                                    <p class="card-text">
                                        Total Transaksi : {{ number_format($row->totaltransaksi) }} <br />
                                        Tanggal Transaksi : {{ date('d F Y', strtotime($row->tanggaltransaksi)) }} <br />
                                        Konfirmasi Status : {{ $row->konfirmasi_status_str }} <br />
                                        Pengiriman : {{ $row->pengiriman_mode }}<br />
                                    </p>

                                    <a href='{{ url("transaksi/detail/$row->kodetransaksi") }}' class="card-link">Detail</a>

                                    @if($row->konfirmasi_status == '0')
                                        <a href='{{ url("transaksi/konfirmasi/$row->kodetransaksi") }}' class="card-link">Konfirmasi</a>
                                    @endif

                                    @if($row->konfirmasi_status == '9')
                                        <a href='{{ url("transaksi/konfirmasi/$row->kodetransaksi") }}' class="card-link">Konfirmasi Ulang</a>
                                    @endif
                                    
                                </div>
                            </div>
                       </div>
                    @endforeach

                    <div class="col-12 mt-5">
                        {{ $paging_transaksi->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


@endsection
