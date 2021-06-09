@extends('admin/template')

@push('scripts')
    <script type="text/javascript">

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
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ $rows->namaanggota }}</h3>
                        <h5 class="widget-user-desc">{{ $rows->useranggota }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src='{{ url("gambar/$rows->gambaranggota") }}' alt="{{ $rows->namaanggota }}" style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $rows->noteleponanggota }}</h5>
                                    <span class="description-text">NO HP</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ date('d F Y', strtotime($rows->dateaddanggota)) }}</h5>
                                    <span class="description-text">TANGGAL REG</span>
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    @if($rows->tanggalaktifsampai == "")
                                        <h5 class="description-header">--</h5>
                                    @else
                                        <h5 class="description-header">{{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }}</h5>
                                    @endif
                                    <span class="description-text">AKTIF SAMPAI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>Nama : {{ $rows->namaanggota }}</h5>
                        <h5>Telepon : {{ $rows->noteleponanggota }}</h5>
                        <h5>Username : {{ $rows->useranggota }}</h5>
                        <h5>Alamat : {{ $rows->alamatanggota }}</h5>
                        @if($rows->tanggalaktifsampai == "")
                            <h5 class="description-header">Aktif Sampai : belum melakukan konfirmasi perpanjangan.</h5>
                        @else
                            <h5>Aktif Sampai : {{ date('d F Y', strtotime($rows->tanggalaktifsampai)) }}</h5>
                        @endif
                        
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/informasi/list") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
