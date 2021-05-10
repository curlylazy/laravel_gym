@extends('admin/template')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#kodeinformasi").addClass("disable");

            $('#isiinformasi').summernote({
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
                    $isiinformasi = $rows->isiinformasi;
                @endphp

                $("#kodeinformasi").addClass("disable");
                $("#kodeinformasi").val("{{ $rows->kodeinformasi }}");
                $("#judulinformasi").val("{{ $rows->judulinformasi }}");

            // DATA BARU
            @elseif($aksi == "acttambah")

                @php
                    $mode = "ADD";
                    $isiinformasi = "";
                @endphp

            @endif

            // =========== jika ada error
            @if(session('erroract'))
                $("#kodeinformasi").val("{{ old('kodeinformasi') }}");
                $("#judulinformasi").val("{{ old('judulinformasi') }}");

                @php
                    $isiinformasi = old('isiinformasi');
                @endphp
            @endif

            // ========== initialize button
            $("#pesanwarning").addClass("hidden");
            $("#isipesanwarning").html("");

            $("#simpan").click(function() {

                if($("#judulinformasi").val() == "")
                {
                    toastr.error('nama [judulinformasi] kosong');
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
                            <label for="kodeinformasi">Kode</label>
                            <input class="form-control" id="kodeinformasi" name="kodeinformasi" type="text" placeholder="AUTO">
                        </div>

                        <div class="form-group">
                            <label for="judulinformasi">Judul Informasi</label>
                            <input type="text" class="form-control" id="judulinformasi" name="judulinformasi" placeholder="masukkan data">
                        </div>

                        <div class="form-group">
                            <label for="isiinformasi">Keterangan Item</label>
                            <textarea rows="5" class="form-control" id="isiinformasi" name="isiinformasi" placeholder="masukkan data">{{ $isiinformasi }}</textarea>
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
