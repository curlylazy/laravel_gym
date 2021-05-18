@extends('admin/template')

@push('scripts')
    <script type="text/javascript">

        function click_statuskonfirmasi(val)
        {
            if(val == 2)
                $("#grup_alasangagal").removeClass("hidden");
            else
                $("#grup_alasangagal").addClass("hidden");
        }

        $(document).ready(function() {

            $("#grup_alasangagal").addClass("hidden");

            $("#kodekonfirmasi").addClass("disable");
            $("#kodekonfirmasi").val("{{ $rows->kodekonfirmasi }}");
            $("#norek").val("{{ $rows->norek }}");
            $("#bank").val("{{ $rows->bank }}");
            $("#an").val("{{ $rows->an }}");
            $("#alasangagal").val("{{ $rows->alasangagal }}");

            @if($rows->gambarbukti != "")
                $("#gambarview").attr("src", "{{ url("gambar/$rows->gambarbukti") }}");
            @else
                $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");
            @endif

            @if($rows->statuskonfirmasi == "0")
                $("#statuskonfirmasi_pending").attr("checked", true);
            @elseif($rows->statuskonfirmasi == "1")
                $("#statuskonfirmasi_pending").attr("checked", true);
            @elseif($rows->statuskonfirmasi == "2")
                $("#statuskonfirmasi_ditolak").attr("checked", true);
                $("#grup_alasangagal").removeClass("hidden");
            @endif

            // =========== jika ada error
            @if(session('erroract'))
                $("#kodekonfirmasi").val("{{ old('kodekonfirmasi') }}");
                $("#norek").val("{{ old('norek') }}");
                $("#bank").val("{{ old('bank') }}");
                $("#an").val("{{ old('an') }}");
            @endif

            // ========== initialize button
            $("#pesanwarning").addClass("hidden");
            $("#isipesanwarning").html("");

            $("#simpan").click(function() {
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

                        <form id="form1" enctype="multipart/form-data" method="post" action='{{ url("admin/$prefix/$aksi") }}' id="form1" >

                        @csrf

                        <div class="form-group">
                            <label for="kodekonfirmasi">Kode</label>
                            <input class="form-control" id="kodekonfirmasi" name="kodekonfirmasi" type="text" placeholder="AUTO">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="norek">No Rek</label>
                                <input type="text" class="form-control disable" id="norek" name="norek" placeholder="masukkan data">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank">Bank</label>
                                <input type="text" class="form-control disable" id="bank" name="bank" placeholder="masukkan data">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="an">A.N</label>
                                <input type="text" class="form-control disable" id="an" name="an" placeholder="masukkan data">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="statuskonfirmasi">Status Konfirmasi</label><br />
                            <input id="statuskonfirmasi_pending" name="statuskonfirmasi" type="radio" onclick="click_statuskonfirmasi(0)" value="0"> Pending <br />
                            <input id="statuskonfirmasi_valid" name="statuskonfirmasi" type="radio" onclick="click_statuskonfirmasi(1)" value="1"> Valid <br />
                            <input id="statuskonfirmasi_ditolak" name="statuskonfirmasi" type="radio" onclick="click_statuskonfirmasi(2)" value="2"> Ditolak <br />
                        </div>

                        <div class="form-group" id="grup_alasangagal">
                            <label for="alasangagal">Alasan Ditolak</label>
                            <input class="form-control" id="alasangagal" name="alasangagal" type="text" placeholder="masukkan keterangan kenapa konfirmasi ditolak">
                        </div>

                        <div class="form-group">
                            <label>Bukti Transfer</label><br />
                            <img src="" id="gambarview" style="width: 200px; border-radius: 10px;">
                        </div>

                        </form>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/$prefix/list") }}'><i class="fa fa-backward"></i> KEMBALI</a>

                        @if($rows->statuskonfirmasi == "0" || $rows->statuskonfirmasi == "2")
                            <button class="btn btn-info" type="button" id="simpan"><i class="fa fa-save"></i> SIMPAN</button>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
