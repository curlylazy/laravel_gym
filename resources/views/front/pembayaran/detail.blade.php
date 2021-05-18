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
                <h1 class="h2 text-uppercase mb-0" style="color: white">Cart</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
        <h2 class="h5 text-uppercase mb-4">Transaksi : <b>{{ $row_transaksi->kodetransaksi }}</b></h2>
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">

                @if($row_transaksi->konfirmasi_status == '2')
                    <p class="alert alert-success">Pesanan anda sudah berhasil dikonfirmasi, silahkan melakukan pengambilan barang, terima kasih.</p>
                @elseif($row_transaksi->konfirmasi_status == '3')
                    <p class="alert alert-success">Anda sudah mengambil pesanan anda, terima kasih sudah berbelanja di toko <b>{{ $row_transaksi->namanelayan }}</b></p>
                @elseif($row_transaksi->konfirmasi_status == '9')
                    <p class="alert alert-danger">Pesanan anda ditolak, <b>{{ $row_transaksi->keteranganditolak }}</b>, <a href='{{ url("transaksi/konfirmasi/$row_transaksi->kodetransaksi") }}'>[Konfirmasi Ulang]</a></p>
                @endif

                <div class="table-responsive mb-4">
                    <table class="table">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Product</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Price</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Quantity</strong></th>
                                <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Total</strong></th>
                                <th class="border-0" scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @foreach ($rows_transaksi_dt as $row)

                            <tr>
                                <th class="pl-0 border-0" scope="row">
                                    <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href='{{ url("item/detail/$row->kodeitem") }}'><img src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}" width="70"></a>
                                        <div class="media-body ml-3">
                                            <strong class="h6"><a class="reset-anchor animsition-link" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namaitem }}</a></strong><br />
                                            <small><a class="reset-anchor animsition-link" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namajenisitem }}</a></small>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">Rp {{ number_format($row->hargaitem) }} / {{ $row->satuan }}</p>
                                </td>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">{{ number_format($row->jumlahitem) }} {{ $row->satuan }}</p>
                                </td>
                                <td class="align-middle border-0">
                                    <p class="mb-0 small">Rp {{ number_format($row->subtotal) }}</p>
                                </td>
                            </tr>

                            @php
                                $no++;
                            @endphp

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-4">

                <div class="card border-0 rounded-0 bg-light mb-1">
                    <div class="card-body" style="font-size: 9pt; font-weight: bold;">
                        NB : barang yang sudah diambil atau dikirim tidak bisa dikembalikan lagi. <br />
                    </div>
                </div> 

                <div class="card border-0 rounded-0 bg-light mb-1">
                    <div class="card-body">
                        Anda melakukan transaksi di toko <br />
                        Nelayan : <b>{{ $row_transaksi->namanelayan }}</b><br />
                        Total Item : <b>{{ $no - 1 }}</b><br />

                        @if($row_transaksi->pengiriman_mode == 'DIKIRIM')
                            Biaya Pengiriman : <b>{{ number_format($row_transaksi->pengiriman_biaya) }}</b><br />
                        @endif

                        Total Transaksi : <b>{{ number_format($row_transaksi->totaltransaksi) }}</b><br />
                        Status : {{ App\Lib\Csql::cekStatusKonfirmasi($row_transaksi->konfirmasi_status) }}<br />
                        Pengiriman : <b>{{ $pengiriman_mode }}</b><br />
                    </div>
                </div> 

                @if($row_transaksi->pengiriman_mode == 'DIKIRIM')
                    <div class="card border-0 rounded-0 bg-light mb-1">
                        <div class="card-body">
                            Data Pengiriman <br />
                            Kabupaten : <b>{{ $row_transaksi->pengiriman_kabupaten }}</b><br />
                            Alamat : <b>{{ $row_transaksi->pengiriman_alamat }}</b><br />
                        </div>
                    </div>
                @endif

                @if($row_transaksi->konfirmasi_status == '2' || $row_transaksi->konfirmasi_status == '3' || $row_transaksi->konfirmasi_status == '9')
                    <div class="card border-0 rounded-0 bg-light mb-1">
                        <div class="card-body">
                            Data Konfirmasi <br />
                            Bank : <b>{{ $row_transaksi->konfirmasi_bank }}</b><br />
                            A.N : <b>{{ $row_transaksi->konfirmasi_an }}</b><br />
                            No Rekening : <b>{{ $row_transaksi->konfirmasi_norek }}</b><br />
                            Tanggal Konfirmasi : <b>{{ date('d F Y', strtotime($row_transaksi->konfirmasi_tanggal)) }}</b>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>

</div>



@endsection
