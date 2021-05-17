@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {
    $("#login").click(function() {

        if($("#useranggota").val() == "")
        {
            Swal.fire("PERINGATAN", "[useranggota] kosong", "warning");
        }
        else if($("#password").val() == "")
        {
            Swal.fire("PERINGATAN", "[password] kosong", "warning");
        }
        else
        {
            $("#form1").submit();
        }
    });
});

</script>

@endpush


@section('content')

<header id="fh5co-header" class="fh5co-cover" role="banner" style="background-image:url({{ asset('cssfront/images/img_bg_3.jpg') }}); height: 200px;" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center" style="margin-top: 50px;">
                <h1 style="color: white;">LOGIN</h1>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-contact">
    <div class="container">

        <div class="row">
            <div class="col-md-8 col-md-offset-2 mx-auto">
                @if(!empty(session('pesaninfo')))
                    {!! session('pesaninfo') !!}
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2 animate-box">
                <form enctype="multipart/form-data" action='{{ url("auth/actlogin") }}' id="form1" method="post">

                    @csrf

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="useranggota">User Anggota</label>
                            <input type="text" class="form-control" id="useranggota" name="useranggota" placeholder="user anggota">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="login" class="btn btn-primary">LOGIN</button>
                        <a type="button" href='{{ url("auth/registrasi") }}' class="btn btn-primary">REGISTRASI</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
