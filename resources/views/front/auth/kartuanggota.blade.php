@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

});

</script>

@endpush


@section('content')

<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{ asset('cssfront/images/img_bg_3.jpg') }}); height: 200px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center" style="margin-top: 50px;">
                <h1 style="color: white;">KARTU ANGGOTA</h1>
                <p style="color: white;">digunakan saat anda berkunjung ke Gym</p>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-trainer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 animate-box">
                <div class="trainer" style="margin-bottom: 10px;">
                    <a href="#"><img class="img-responsive" src='{{ url("gambar/$rows->gambaranggota") }}' alt="trainer"></a>
                    <div class="title">
                        <h3><a href="#">{{ $rows->kodeanggota }}</a></h3>
                        <span>{{ $rows->dateaddanggota }}</span>
                    </div>
                </div>
                {!! QrCode::size(300)->generate($rows->kodeanggota); !!}
            </div>

            <div class="col-md-8 animate-box">
                <h3><small>Kode Anggota</small><br />{{ $rows->kodeanggota }}</h3>
                <h3><small>Username</small><br />{{ $rows->useranggota }}</h3>
                <h3><small>Nama</small><br />{{ $rows->namaanggota }}</h3>
                <h3><small>Notelepon</small><br />{{ $rows->noteleponanggota }}</h3>
                <h3><small>Alamat</small><br />{{ $rows->alamatanggota }}</h3>
                <h3><small>J.K</small><br />{{ $rows->jk }}</h3>

                @if($rows->tanggalaktifsampai == '')
                    <h3><small>Tanggal Aktif Sampai</small><br />belum melakukan pembayaran</h3>
                @elseif(date('Y-m-d') > $rows->tanggalaktifsampai)
                    <h3><small>Tanggal Aktif Sampai</small><br /> {{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }} (masa aktif sudah habis)
                @else
                    <h3><small>Tanggal Aktif Sampai</small><br />{{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }}</h3>
                @endif

                
            </div>
        </div>
    </div>
</div>




@endsection
