@extends('admin/template')

@push('scripts')
    <script type="text/javascript">
		$(document).ready(function() {

            $("#kodeadmin").addClass("disable");

			// DATA EDIT
			@if($aksi == "actedit")

				@php
					$mode = "UPDATE";
				@endphp

                $("#kodeadmin").val("{{ $rows->kodeadmin }}");
                $("#useradmin").val("{{ $rows->useradmin }}");
                $("#useradmin_old").val("{{ $rows->useradmin }}");
                $("#namaadmin").val("{{ $rows->namaadmin }}");
                $("#password").val("{{ $password }}");

			// DATA BARU
			@elseif($aksi == "acttambah")

				@php
					$mode = "ADD";
				@endphp

			@endif

			// =========== jika ada error
			@if(session('erroract'))
				$("#kodeadmin").val("{{ old('kodeadmin') }}");
                $("#useradmin").val("{{ old('useradmin') }}");
                $("#useradmin_old").val("{{ old('useradmin') }}");
                $("#namaadmin").val("{{ old('namaadmin') }}");
                $("#password").val("{{ old('password') }}");
			@endif

			// ========== initialize button
			$("#pesanwarning").addClass("hidden");
			$("#isipesanwarning").html("");

			$("#simpan").click(function() {

                 // jika data kosong
				var namaadmin = $("#namaadmin").val();
				var useradmin = $("#useradmin").val();
				var password = $("#password").val();

				if(useradmin == "")
				{
                    toastr.error("kesalahan [useradmin] kosong");
                }
                else if(namaadmin == "")
				{
					toastr.error("kesalahan [namaadmin] kosong");
                }
                else if(password == "")
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

                        <input type="hidden" class="form-control" id="useradmin_old" name="useradmin_old" placeholder="masukkan data">

                        <div class="form-group">
                            <label for="kodeadmin">Kode</label>
                            <input class="form-control" id="kodeadmin" name="kodeadmin" type="text" placeholder="AUTO">
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="useradmin">Username</label>
                                <input type="text" class="form-control" id="useradmin" name="useradmin" placeholder="masukkan data">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="masukkan data">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="namaadmin">Nama</label>
                            <input type="text" class="form-control" id="namaadmin" name="namaadmin" placeholder="masukkan data">
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
