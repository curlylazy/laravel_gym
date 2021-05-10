@extends('admin/template')

@push('scripts')
    <script type="text/javascript">

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function makepass(length) {
            var result           = [];
            var characters       = 'abcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result.push(characters.charAt(Math.floor(Math.random() * charactersLength)));
            }
           return result.join('');
        }

        $(document).ready(function() {

            $("#kodeanggota").addClass("disable");
            $("#tanggalaktifsampai").addClass("disable");

            // DATA EDIT
            @if($aksi == "actedit")

                @php
                    $mode = "UPDATE";
                @endphp

                $("#kodeanggota").val("{{ $rows->kodeanggota }}");
                $("#useranggota").val("{{ $rows->useranggota }}");
                $("#useranggota_old").val("{{ $rows->useranggota }}");
                $("#password").val("{{ $password }}");
                $("#namaanggota").val("{{ $rows->namaanggota }}");
                $("#noteleponanggota").val("{{ $rows->noteleponanggota }}");
                $("#alamatanggota").val("{{ $rows->alamatanggota }}");
                $("#jk").val("{{ $rows->jk }}");
                $("#tanggalaktifsampai").val("{{ $rows->tanggalaktifsampai }}");

                @if($rows->gambaranggota != "")
                    $("#gambarview").attr("src", "{{ url("gambar/$rows->gambaranggota") }}");
                @else
                    $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");
                @endif

            // DATA BARU
            @elseif($aksi == "acttambah")

                @php
                    $mode = "ADD";
                @endphp

                $("#password").val(makepass(5));
                $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");

            @endif

            // =========== jika ada error
            @if(session('erroract'))
                $("#kodeanggota").val("{{ old('kodeanggota') }}");
                $("#useranggota").val("{{ old('useranggota') }}");
                $("#useranggota_old").val("{{ old('useranggota') }}");
                $("#password").val("{{ old('password') }}");
                $("#namaanggota").val("{{ old('namaanggota') }}");
                $("#noteleponanggota").val("{{ old('noteleponanggota') }}");
                $("#alamatanggota").val("{{ old('alamatanggota') }}");
                $("#jk").val("{{ old('jk') }}");
                $("#tanggalaktifsampai").val("{{ old('tanggalaktifsampai') }}");
            @endif

            // ========== initialize button
            $("#pesanwarning").addClass("hidden");
            $("#isipesanwarning").html("");

            $("#simpan").click(function() {

                 // jika data kosong
                var namaadmin = $("#namaadmin").val();
                var useradmin = $("#useradmin").val();
                var password = $("#password").val();

                if($("#useranggota").val() == "")
                {
                    toastr.error("kesalahan [useranggota] kosong");
                }
                else if(!isEmail($("#useranggota").val()))
                {
                    toastr.error("useranggota harus berupa email");
                }
                else if($("#namaanggota").val() == "")
                {
                    toastr.error("kesalahan [namaanggota] kosong");
                }
                else if($("#password").val() == "")
                {
                    toastr.error("kesalahan [password] kosong");
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


<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h4 class="m-0 text-dark" style="letter-spacing: 2px;">{{ $pagename }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                   {!! $breadcrumb !!}
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- cek apakah informasi -->
        @if (session('pesaninfo'))
            <div class="row">
                <div class="col-12 col-md-12">
                    {!! session('pesaninfo') !!}
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">

                        <form id="form1" enctype="multipart/form-data" method="post" action='{{ url("admin/$prefix/$aksi") }}' id="form1" >

                        @csrf

                        <input type="hidden" class="form-control" id="useranggota_old" name="useranggota_old" placeholder="masukkan data">

                        <div class="form-group">
                            <label for="kodeanggota">Kode</label>
                            <input class="form-control" id="kodeanggota" name="kodeanggota" type="text" placeholder="AUTO">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="useranggota">Useranggota</label>
                                <input type="text" class="form-control" id="useranggota" name="useranggota" placeholder="masukkan data">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="masukkan data">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="namaanggota">Nama</label>
                            <input type="text" class="form-control" id="namaanggota" name="namaanggota" placeholder="masukkan data">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="noteleponanggota">No Telepon</label>
                                <input type="text" class="form-control" id="noteleponanggota" name="noteleponanggota" placeholder="masukkan data">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jk">J.K</label>
                                <select type="text" class="form-control" id="jk" name="jk" placeholder="masukkan data">
                                    <option value="L">Laki Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamatanggota">Alamat</label>
                            <input type="text" class="form-control" id="alamatanggota" name="alamatanggota" placeholder="masukkan data">
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" id="gambaranggota" name="gambaranggota"><br />
                            <img src="" id="gambarview" style="width: 200px; border-radius: 10px;">
                        </div>

                        </form>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/$prefix/list") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                        <button class="btn btn-info" type="button" id="simpan"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
