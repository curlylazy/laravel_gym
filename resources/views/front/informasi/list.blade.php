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
                <h1 style="color: white;">INFORMASI</h1>
                <p>informasi seputar kesehatan dan info Tiger Gym.</p>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-blog" class="fh5co-bg-section">
    <div class="container">
        <div class="row animate-box">
            @if(count($rows) == 0)
                <div class="col-12">
                    <p class="text-center">Belum ada informasi</p>
                </div>
            @endif
        </div>
        <div class="row row-bottom-padded-md">
            @foreach ($rows as $row)
                <div class="col-lg-4 col-md-4">
                    <div class="fh5co-blog animate-box">
                        <div class="blog-text">
                            <h3><a href=""#>{{ $row->judulinformasi }}</a></h3>
                            <span class="posted_on">{{ date('d F Y', strtotime($row->dateaddinformasi)) }}</span>
                            <span class="comment"><a href="">by : {{ $row->namaadmin }}</a></span>
                            <p>{{ substr(strip_tags($row->isiinformasi), 0, 100) }} ..</p>
                            <a href="#" class="btn btn-primary">Read More</a>
                        </div> 
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
