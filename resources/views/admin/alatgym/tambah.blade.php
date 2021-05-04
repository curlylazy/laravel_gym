@extends('admin/template')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#kodeitem").addClass("disable");

            $('#keteranganalatgym').summernote({
                placeholder: 'masukkan data.',
                tabsize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                    ['help', ['help']]
                ],
            });

            // DATA EDIT
            @if($aksi == "actedit")

                @php
                    $mode = "UPDATE";
                    $keteranganalatgym = $rows->keteranganalatgym;
                @endphp

                $("#kodealatgym").addClass("disable");
                $("#kodealatgym").val("{{ $rows->kodealatgym }}");
                $("#namaalatgym").val("{{ $rows->namaalatgym }}");

                @if($rows->gambaralatgym != "")
                    $("#gambarview").attr("src", "{{ url("gambar/$rows->gambaralatgym") }}");
                @endif

            // DATA BARU
            @elseif($aksi == "acttambah")

                @php
                    $mode = "ADD";
                    $keteranganalatgym = "";
                @endphp

                $("#gambarview").attr("src", "{{ url('gambar/noimage.jpg') }}");

            @endif

            // =========== jika ada error
            @if(session('erroract'))
                $("#kodealatgym").val("{{ old('kodealatgym') }}");
                $("#namaalatgym").val("{{ old('namaalatgym') }}");
                @php
                    $keteranganalatgym = old('keteranganalatgym');
                @endphp
            @endif

            // ========== initialize button
            $("#pesanwarning").addClass("hidden");
            $("#isipesanwarning").html("");

            $("#simpan").click(function() {

                if($("#namaalatgym").val() == "")
                {
                    toastr.error('nama [namaalatgym] kosong');
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

                        <div class="form-group">
                            <label for="kodealatgym">Kode</label>
                            <input class="form-control" id="kodealatgym" name="kodealatgym" type="text" placeholder="AUTO">
                        </div>

                        <div class="form-group">
                            <label for="namaalatgym">Nama Alat Gym</label>
                            <input type="text" class="form-control" id="namaalatgym" name="namaalatgym" placeholder="masukkan data">
                        </div>

                        <div class="form-group">
                            <label for="keteranganitem">Keterangan Item</label>
                            <textarea rows="5" class="form-control" id="keteranganitem" name="keteranganitem" placeholder="masukkan data">{{ $keteranganitem }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" id="gambaralatgym" name="gambaralatgym" class="form-control"><br />
                            <img src="" id="gambarview" style="width: 200px; border-radius: 10px;">
                        </div>

                        

                        </form>

                    </div>
                    <div class="card-footer">
                        <a class="btn btn-sm btn-primary" href='{{ url("admin/$prefix/list") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                        <button class="btn btn-sm btn-info" type="button" id="simpan"><i class="fa fa-save"></i> SIMPAN</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
