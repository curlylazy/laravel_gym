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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Useranggota</th>
                                    <th>Bank</th>
                                    <th>No Rek</th>
                                    <th>A.N</th>
                                    <th>Tanggal Konfirmasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)

                                    <tr>
                                        <td>{{ $row->kodekonfirmasi }}</td>
                                        <td>{{ $row->useranggota }}</td>
                                        <td>{{ $row->bank }}</td>
                                        <td>{{ $row->norek }}</td>
                                        <td>{{ $row->an }}</td>
                                        <td>{{ date('d F Y', strtotime($row->tanggalkonfirmasi)) }}</td>
                                        <td>{{ App\Lib\Cview::StatusKonfirmasi($row->statuskonfirmasi) }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href='{{ url("admin/$prefix/detail/$row->kodekonfirmasi") }}'><i class="fa fa-edit"></i></a>
                                            <a class="btn btn-sm btn-danger" onclick="confirmDelete('Hapus data {{ $pagename }} dengan kode {{ $row->kodekonfirmasi }}', '{{ url("admin/$prefix/acthapus/$row->kodekonfirmasi") }}')" href="javascript:void(0)"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/dashboard") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                        <a class="btn btn-info" href='{{ url("admin/$prefix/tambah") }}'><i class="fa fa-plus"></i> TAMBAH</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
