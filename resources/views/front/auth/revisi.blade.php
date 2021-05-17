@extends('front/template')

@push('scripts')

<script type="text/javascript">

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

$(document).ready(function() {

    $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");

    $("#kodeanggota").val("{{ $rows->kodeanggota }}");
    $("#useranggota_old").val("{{ $rows->useranggota }}");
    $("#useranggota").val("{{ $rows->useranggota }}");
    $("#namaanggota").val("{{ $rows->namaanggota }}");
    $("#password").val("{{ $password_dec }}");
    $("#noteleponanggota").val("{{ $rows->noteleponanggota }}");
    $("#alamatanggota").val("{{ $rows->alamatanggota }}");

    @if($rows->gambaranggota != "")
        $("#gambarview").attr("src", "{{ url("gambar/$rows->gambaranggota") }}");
    @else
        $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");
    @endif

    @if($rows->jk == "L")
        $("#jk_lakilaki").attr('checked', true);
    @else
        $("#jk_wanita").attr('checked', true);
    @endif

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
                <h1 style="color: white;">REVISI</h1>
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
                    <h3>Alasan Ditolak</h3>
                    <p>ada kendala dalam proses verifikasi, berikut adalah alasan kenapa pendaftaran anda ditolak : <b>{{ $rows->alasanditolak }}</b></p>
                </div>

            </div>
            <div class="col-md-8 animate-box">
                <form enctype="multipart/form-data" action='{{ url("auth/actrevisi") }}' id="form1" method="post">

                    @csrf

                    <input type="text" class="form-control hidden" id="kodeanggota" name="kodeanggota">
                    <input type="text" class="form-control hidden" id="useranggota_old" name="useranggota_old">

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

                    <div class="row form-group">
                        <div class="col-md-12">
                            <img id="gambarview" style="width: 250px;" />
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
