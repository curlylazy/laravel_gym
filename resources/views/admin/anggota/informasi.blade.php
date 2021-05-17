@extends('admin/template')

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
        	$('#myTable').DataTable({"ordering": false});
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
            @foreach ($rows as $row)
                <div class="col-md-4">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-info">
                            <a href='{{ url("admin/anggota/detail/$row->kodeanggota") }}'><h3 class="widget-user-username">{{ $row->namaanggota }}</h3></a>
                            <h5 class="widget-user-desc">{{ $row->useranggota }}</h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" src='{{ url("gambar/$row->gambaranggota") }}' alt="{{ $row->namaanggota }}" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">NO HP</h5>
                                        <span class="description-text">{{ $row->noteleponanggota }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">TANGGAL REG</h5>
                                        <span class="description-text">{{ date('d F Y', strtotime($row->dateaddanggota)) }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">AKTIF SAMPAI</h5>
                                        @if($row->tanggalaktifsampai == "")
                                            <span class="description-text">--</span>
                                        @else
                                            <span class="description-text">{{ date('d F Y', strtotime($row->tanggalaktifsampai)) }}</span>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/dashboard") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
