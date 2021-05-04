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
                <h1 class="h2 text-uppercase mb-0" style="color: white">Login</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-3 bg-light mt-2">
    <div class="container">
        
        @if(session('erroract'))
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-7 col-md-7 mx-auto">
                <form id="form1" method="post" action='{{ url("auth/actlogin") }}'>

                    @csrf

                    <div class="form-group">
                        <label for="userpelanggan">Username</label>
                        <input type="text" class="form-control" id="userpelanggan" name="userpelanggan" placeholder="masukkan user pelanggan">
                    </div>

                    <div class="form-group">
                        <label for="userpelanggan">Password</label>
                        <input type="text" class="form-control" id="passwordpelanggan" name="passwordpelanggan" placeholder="masukkan password">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</button>
                    <a href="{{ url('auth/registrasi') }}" class="btn btn-primary"><i class="fas fa-user"></i> Registrasi</a>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
