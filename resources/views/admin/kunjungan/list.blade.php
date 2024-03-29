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
                                    <th>Nama</th>
                                    <td>Operator</td>
                                    <td>Tanggal</td>
                                    <td>Waktu</td>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)

                                    <tr>
                                        <td>{{ $row->kodekunjungan }}</td>
                                        <td>{{ $row->useranggota }}</td>
                                        <td>{{ $row->namaanggota }}</td>
                                        <td>{{ $row->namaadmin }}</td>
                                        <td>{{ date('d F Y', strtotime($row->dateaddkunjungan)) }}</td>
                                        @if(!empty($row->waktudatang))
                                            <td><i class="fas fa-arrow-right"></i> [Datang] {{ date('H:i:s', strtotime($row->waktudatang)) }}</td>
                                        @else
                                            <td><i class="fas fa-arrow-left"></i> [Pulang] {{ date('H:i:s', strtotime($row->waktupulang)) }}</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-danger btn-sm" onclick="return confirm('Hapus data {{ $row->kodekunjungan }} ? ')" href='{{ url("admin/$prefix/acthapus/$row->kodekunjungan") }}'><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-warning" href='{{ url("admin/dashboard") }}'><i class="fa fa-backward"></i> KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
