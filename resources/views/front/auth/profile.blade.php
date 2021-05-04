@extends('front/template')

@push('scripts')

<script type="text/javascript">

$(document).ready(function() {

    $("#userpelanggan").val("{{ $rows->userpelanggan }}");
    $("#userpelanggan_old").val("{{ $rows->userpelanggan }}");
    $("#namapelanggan").val("{{ $rows->namapelanggan }}");
    $("#passwordpelanggan").val("{{ $passwordpelanggan }}");
    $("#emailpelanggan").val("{{ $rows->emailpelanggan }}");
    $("#alamatpelanggan").val("{{ $rows->alamatpelanggan }}");
    $("#noteleponpelanggan").val("{{ $rows->noteleponpelanggan }}");

    $("#gambarview").attr("src", '{{ url("gambar/$rows->gambarpelanggan") }}');

    @if(session('erroract'))
        $("#userpelanggan").val("{{ old('userpelanggan') }}");
        $("#userpelanggan_old").val("{{ old('userpelanggan') }}");
        $("#namapelanggan").val("{{ old('namapelanggan') }}");
        $("#passwordpelanggan").val("{{ old('passwordpelanggan') }}");
        $("#emailpelanggan").val("{{ old('emailpelanggan') }}");
        $("#alamatpelanggan").val("{{ old('alamatpelanggan') }}");
        $("#noteleponpelanggan").val("{{ old('noteleponpelanggan') }}");
    @endif

    $("#simpan").click(function() {

        // jika data kosong
        var namapelanggan = $("#namapelanggan").val();
        var userpelanggan = $("#userpelanggan").val();
        var passwordpelanggan = $("#passwordpelanggan").val();

        if(userpelanggan == "")
        {
            Swal.fire("PERINGATAN", "nama [userpelanggan] kosong", "warning");
        }
        else if(namapelanggan == "")
        {
            Swal.fire("PERINGATAN", "nama [namapelanggan] kosong", "warning");
        }
        else if(passwordpelanggan == "")
        {
            Swal.fire("PERINGATAN", "nama [passwordpelanggan] kosong", "warning");
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

<!-- Page Header -->
<section class="py-3 bg-light" style="background:linear-gradient(0deg, rgba(0 0 0 / 30%), rgba(0 25 49)), url({{ asset('cssfront/img/banner_2.jpg') }}); background-position: center; background-size: cover;">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0" style="color: white">Profile</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-lg-end mb-0 px-0" style="background: none;">
                        <li class="breadcrumb-item" style="color: white"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<section class="py-3 bg-light mt-2">
    <div class="container">

        @if(!empty(session('pesaninfo')))
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <form id="form1" enctype="multipart/form-data" method="post" action='{{ url("auth/actupdateprofile") }}'>

                    @csrf

                    <div class="row">
                        <div class="col">
                            <label for="userpelanggan">Username</label>
                            <input type="text" class="form-control" id="userpelanggan" name="userpelanggan" placeholder="masukkan user pelanggan">
                            <input type="hidden" class="form-control" id="userpelanggan_old" name="userpelanggan_old" placeholder="masukkan user pelanggan">
                        </div>
                        <div class="col">
                            <label for="userpelanggan">Password</label>
                            <input type="text" class="form-control" id="passwordpelanggan" name="passwordpelanggan" placeholder="masukkan password">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="userpelanggan">Nama</label>
                        <input type="text" class="form-control" id="namapelanggan" name="namapelanggan" placeholder="masukkan nama">
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <label for="userpelanggan">Email</label>
                            <input type="text" class="form-control" id="emailpelanggan" name="emailpelanggan" placeholder="masukkan email">
                        </div>
                        <div class="col">
                            <label for="userpelanggan">Alamat</label>
                            <input type="text" class="form-control" id="alamatpelanggan" name="alamatpelanggan" placeholder="masukkan alamat">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="userpelanggan">No Telepon</label>
                        <input type="text" class="form-control" id="noteleponpelanggan" name="noteleponpelanggan" placeholder="masukkan no telepon">
                    </div>

                    <div class="form-group mt-3">
                        <label>Photo</label>
                        <input type="file" id="gambarpelanggan" name="gambarpelanggan" class="form-control"><br />
                        <img src="" id="gambarview" style="width: 200px; border-radius: 10px;">
                    </div>

                    <button type="button" id="simpan" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
