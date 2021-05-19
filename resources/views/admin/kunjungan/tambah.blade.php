@extends('admin/template')

@push('stylecss')

<style type="text/css">
    
</style>

@endpush

@push('scripts')
    <script type="text/javascript">

        $(document).ready(function() {

            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            @if(!empty($rows->kodeanggota))
                $("#kodeanggota").val("{{ $rows->kodeanggota }}");
            @endif

            // =========== jika ada error
            @if(session('erroract'))
                $("#kodeanggota").val("{{ old('kodeanggota') }}");
            @endif

            // ========== initialize button
            $("#pesanwarning").addClass("hidden");
            $("#isipesanwarning").html("");

            $("#simpan").click(function() {

                if($("input[name='waktu']:checked").val() == null)
                {
                    toastr.error("silahkan pilih datang / pulang");
                    return;
                }

                $("#form1").attr("action", '{{ url("admin/$prefix/$aksi") }}');
                $("#form1").submit();
            });

            $("#cari").click(function() {
                $("#form1").attr("action", '{{ url("admin/$prefix/tambah") }}');
                $("#form1").submit();
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

                        <form id="form1" enctype="multipart/form-data" method="post" action='{{ url("admin/$prefix/$aksi") }}' id="form1" autocomplete="off">

                        @csrf

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" id="kodeanggota" name="kodeanggota" type="text" placeholder="masukkan kode anggota / useranggota">
                                <div class="input-group-prepend">
                                    <button type="button" id="cari" class="btn btn-info"><i class="fas fa-search"></i> CARI</button>
                                </div>
                            </div>
                        </div>

                        @if(!empty($rows->kodeanggota))
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <img src='{{ url("gambar/$rows->gambaranggota") }}' style="width: 100%; height: 450px; border-radius: 10px; object-fit: cover;" />
                                </div>
                                <div class="form-group col-md-8">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><h4><small>Username</small><br />{{ $rows->useranggota }}</h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4><small>Nama</small><br />{{ $rows->namaanggota }}</h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4><small>Alamat</small><br />{{ $rows->alamatanggota }}</h4></td>
                                            </tr>
                                            <tr>
                                                <td><h4><small>Notelepon</small><br />{{ $rows->noteleponanggota }}</h4></td>
                                            </tr>
                                            @if($rows->tanggalaktifsampai == '')
                                                <tr>
                                                    <td><h4><small>Status Aktif</small><br />belum melakukan pembayaran pertama.</h4></td>
                                                </tr>
                                            @elseif(date('Y-m-d') > $rows->tanggalaktifsampai)
                                                <tr>
                                                    <td><h4><small>Status Aktif</small><br />{{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }} (masa aktif sudah habis)</h4></td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td><h4><small>Status Aktif</small><br />{{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }}</h4></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Useranggota</label><br />
                                    <input type="radio" id="waktu_datang" style="height:35px; width:35px; vertical-align: middle;" name="waktu" value="waktu_datang"> Datang
                                    <input type="radio" id="waktu_pulang" style="height:35px; width:35px; vertical-align: middle; margin-left: 20px;" name="waktu" value="waktu_pulang"> Pulang
                                </div>
                            </div>
                        @endif
                        
                        </form>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/$prefix/list") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                        @if(!empty($rows->kodeanggota))
                            <button class="btn btn-info" type="button" id="simpan"><i class="fa fa-save"></i> SIMPAN</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
