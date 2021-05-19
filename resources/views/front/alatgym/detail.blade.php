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
                <h1 style="color: white;">{{ $rows->judulinformasi }}</h1>
                <p>{{ date('d F Y', strtotime($rows->dateaddinformasi)) }} <br /> by : {{ $rows->namaadmin }}</p>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-blog" class="fh5co-bg-section">
    <div class="container">
        <div class="row row-bottom-padded-md">
           <div class="col-lg-12 col-md-12">
                <div class="fh5co-blog animate-box">
                    <div class="blog-text">
                        {!! $rows->isiinformasi !!}
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
