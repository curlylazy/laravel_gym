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

    <form id="form1" method="post" action='{{ url("cart/actupdate") }}'>
    @csrf

    @if(!empty(session('pesaninfo')))
        <section class="py-3 mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        {!! session('pesaninfo') !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if(count($rows) == 0)
        <section class="py-3 mt-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="alert alert-warning">cart anda masih kosong.</div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="py-5">
            <h2 class="h5 text-uppercase mb-4">Keranjang Belanja</h2>
            <div class="row">
                <div class="col-lg-8 mb-4 mb-lg-0">
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

                                @foreach ($rows as $row)

                                <input type="hidden" name="kodecart_{{ $no }}" value="{{ $row->kodecart }}">

                                <tr>
                                    <th class="pl-0 border-0" scope="row">
                                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href='{{ url("item/detail/$row->kodeitem") }}'><img src='{{ url("gambar/$row->gambaritem") }}' alt="{{ $row->namaitem }}" width="70"></a>
                                            <div class="media-body ml-3">
                                                <strong class="h6"><a class="reset-anchor animsition-link" href='{{ url("item/detail/$row->kodeitem") }}'>{{ $row->namaitem }}</a></strong><br />
                                                <small><a class="reset-anchor animsition-link" href='{{ url("nelayan/detail/$row->kodenelayan") }}'>{{ $row->namanelayan }}</a></small>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="align-middle border-0">
                                        <p class="mb-0 small">Rp {{ number_format($row->hargaitem) }} / {{ $row->satuan }}</p>
                                    </td>
                                    <td class="align-middle border-0">
                                        <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
                                            <div class="quantity">
                                                <button type="button" class="dec-btn p-0"><i class="fas fa-caret-left"></i></button>
                                                    <input class="form-control form-control-sm border-0 shadow-0 p-0" type="text" name="jumlah_{{ $no }}" value="{{ $row->jumlah }}">
                                                <button type="button" class="inc-btn p-0"><i class="fas fa-caret-right"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle border-0">
                                        <p class="mb-0 small">Rp {{ number_format($row->subtotal) }}</p>
                                    </td>
                                    <td class="align-middle border-0"><a class="reset-anchor" onclick="return confirm('hapus item ini dari keranjang belanja')" href='{{ url("cart/actdelete/$row->kodecart") }}'><i class="fas fa-trash-alt small text-muted"></i></a></td>
                                </tr>

                                @php
                                    $no++;
                                @endphp

                                @endforeach

                                <input type="hidden" name="jmlrow" value="{{ $no - 1 }}">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 rounded-0 bg-light mb-1">
                        <div class="card-body">
                            Anda melakukan transaksi di {{ $jmltokoincart }} toko
                            <ul class="list-unstyled mt-2">
                                @foreach ($rows_toko as $row)
                                    <a href="#"><li style="font-size: 11pt;" class="d-flex align-items-center "><span class="mr-2">{{ $row->namanelayan }}</span> (Rp. {{ number_format($row->totaltransaksi) }})</li></a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="card border-0 rounded-0 bg-light">
                        <div class="card-body">
                            <h5 class="text-uppercase mb-4">Cart Total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between">
                                    <strong class="text-uppercase small font-weight-bold"></strong>
                                </li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong class="text-uppercase small font-weight-bold">Total</strong><span>{{ number_format($grandtotal) }}</span></li>
                                <li>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-dark btn-sm btn-block" type="submit"> <i class="fas fa-save mr-2"></i>Update Cart</button>
                                        <a class="btn btn-dark btn-sm btn-block" href='{{ url("item") }}'> <i class="fas fa-cube mr-2"></i>Add Item</a>
                                        <a class="btn btn-primary btn-sm btn-block" href='{{ url("cart/checkout") }}'> <i class="fas fa-dollar-sign mr-2"></i>Proses Checkout</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    </form>

</div>



@endsection
