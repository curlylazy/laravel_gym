@extends('front/template')

@push('scripts')

<script type="text/javascript">

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).ready(function() {

    $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");

    @if(session('erroract'))
        $("#useranggota").val("{{ old('useranggota') }}");
        $("#namaanggota").val("{{ old('namaanggota') }}");
        $("#password").val("{{ old('password') }}");
        $("#noteleponanggota").val("{{ old('noteleponanggota') }}");
        $("#alamatanggota").val("{{ old('alamatanggota') }}");
    @endif

    $("#simpan").click(function() {

        if($("#useranggota").val() == "")
        {
            Swal.fire("PERINGATAN", "[useranggota] kosong", "warning");
        }
        else if(!isEmail($("#useranggota").val()))
        {
            Swal.fire("PERINGATAN", "username harus berupa email", "warning");
        }
        else if($("#namaanggota").val() == "")
        {
            Swal.fire("PERINGATAN", "[namaanggota] kosong", "warning");
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
                <h1 style="color: white;">REGISTRASI</h1>
            </div>
        </div>
    </div>
</header>

<div id="fh5co-contact">
    <div class="container">

        <div class="row">
            <div class="col-lg-12 mx-auto">
                @if(!empty(session('pesaninfo')))
                    {!! session('pesaninfo') !!}
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 animate-box">
                    
                <div class="fh5co-contact-info">
                    <h3>Registrasi Info</h3>
                    <p>setelah melakukan registrasi, data anda akan divalidasi terlebih dahulu oleh staff kami, dan jika sudah berhasil, silahkan melakukan konfirmasi pembayaran.</p>
                </div>

            </div>
            <div class="col-md-8 animate-box">
                <form enctype="multipart/form-data" action='{{ url("auth/actregistrasi") }}' id="form1" method="post">

                    @csrf

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="useranggota">User Anggota</label>
                            <input type="text" class="form-control" id="useranggota" name="useranggota" placeholder="user anggota">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="namaanggota">Nama</label>
                            <input type="text" class="form-control" id="namaanggota" name="namaanggota" placeholder="nama anda">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="noteleponanggota">Telepon</label>
                            <input type="text" class="form-control" id="noteleponanggota" name="noteleponanggota" placeholder="telepon anda">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="alamatanggota">Alamat</label>
                            <input type="text" class="form-control" id="alamatanggota" name="alamatanggota" placeholder="alamat anda">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="alamatanggota">JK</label><br />
                            <input type="radio" id="jk_lakilaki" name="jk" value="L"> Laki Laki
                            <input type="radio" id="jk_wanita" name="jk" value="P"> Perempuan
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <label for="gambaranggota">Photo Profile</label>
                            <input type="file" class="form-control" id="gambaranggota" name="gambaranggota" placeholder="nama anda">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="simpan" class="btn btn-primary">SIMPAN</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




@endsection
