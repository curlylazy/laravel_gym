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
                <h1 style="color: white;">ALAT GYM</h1>
                <p style="color: white;">pengenalan alat alat gym yang ada di Tiger Gym</p>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-gallery">
    <div class="container-fluid">
        <div class="row row-bottom-padded-md">
            <div class="col-md-12">
                <ul id="fh5co-portfolio-list">

                    @foreach ($rows as $row)
                        <li class="one-third animate-box" data-animate-effect="fadeIn" style='background-image: url({{ url("gambar/$row->gambaralatgym") }}); '>
                            <a href='{{ url("informasi/detail/$row->kodealatgym") }}'>
                                <div class="case-studies-summary" style="background-color: #0000008a; padding: 10px;">
                                    <span>by : {{ $row->namaadmin }}</span>
                                    <h2>{{ $row->namaalatgym }}</h2>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <div id="fh5co-blog" class="fh5co-bg-section">
    <div class="container">
        <div class="row animate-box">
            @if(count($rows) == 0)
                <div class="col-12">
                    <p class="text-center">Belum ada data</p>
                </div>
            @endif
        </div>
        <div class="row row-bottom-padded-md">
            @foreach ($rows as $row)
                <div class="col-lg-4 col-md-4">
                    <div class="fh5co-blog animate-box">
                        <a href="#"><img class="img-responsive" src='{{ url("gambar/$row->gambaralatgym") }}' alt=""></a>
                        <div class="blog-text">
                            <h3><a href='{{ url("informasi/detail/$row->kodealatgym") }}'>{{ $row->namaalatgym }}</a></h3>
                            <span class="posted_on">{{ date('d F Y', strtotime($row->dateaddalatgym)) }}</span>
                            <span class="comment"><a href="">by : {{ $row->namaadmin }}</a></span>
                            <p>{{ substr(strip_tags($row->keteranganalatgym), 0, 100) }} ..</p>
                            <a href='{{ url("informasi/detail/$row->kodealatgym") }}' class="btn btn-primary">Selengkapnya..</a>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div> -->

@endsection
