@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {
    $("#katakunci").val("{{ session('search_katakunci') }}");
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
                <p>Untuk memperpanjang masa aktif keanggotaan anda, silahkan melakukan pembayaran.</p>
            </div>
        </div>
    </div>
</header>


<div id="fh5co-pricing">
    <div class="container">
        <div class="row">
            <div class="col-12" style="padding-bottom: 30px;">
                <a id="simpan" href="{{ url('pembayaran/tambah') }}" class="btn btn-primary">TAMBAH PEMBAYARAN</a>
            </div>
            @if(count($rows_transaksi) == 0)
                <div class="col-12">
                    <p class="text-center">Belum ada transaksi</p>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="pricing">
                @foreach ($rows_transaksi as $row)
                    <div class="col-md-4 animate-box">
                        <div class="price-box">
                            <h2 class="pricing-plan">{{ $row->kodekonfirmasi }}</h2>
                            <ul class="classes">
                                <li>Bank : {{ $row->bank }}</li>
                                <li class="color">No Rek : {{ $row->norek }}</li>
                                <li>A.N : {{ $row->an }}</li>
                                <li class="color">Tgl Konfirmasi : {{ date('d F Y', strtotime($row->tanggalkonfirmasi)) }}</li>
                                <li>{{ App\Lib\Cview::StatusKonfirmasi($row->statuskonfirmasi) }}</li>
                            </ul>

                            @if($row->statuskonfirmasi == 2)
                                <a href='{{ url("pembayaran/edit/$row->kodekonfirmasi") }}' class="btn btn-select-plan btn-sm">Konfirmasi Ulang</a>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-12">
                    {{ $paging_transaksi->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
