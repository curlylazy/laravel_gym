<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cetak</title>
        <link rel="stylesheet" href="{{ asset('csstable/table.css') }}">
        
    </head>
    <body>

    	<center>
    		<span style="font-size: 20pt;">{{ strtoupper($judul) }}</span><br />
    		<span>{{ App\Lib\Cview::LapAlamat }} {{ App\Lib\Cview::LapTelp }}</span><br />
    		<span>{!! $keterangan !!}</span><br /><br />
    		<hr />
    	</center>


        <table class="minimalistBlack">
        	<thead>
	        	<tr>
	        		<th style="width: 100px;">No</th>
					<th>Kode</th>
                    <th>Useranggota</th>
                    <th>Nama</th>
                    <td>Operator</td>
                    <td>Tanggal</td>
                    <td>Waktu</td>
	        	</tr>
        	</thead>

        	@php
				$no = 1;
			@endphp

			<tbody>
				
				@foreach ($rows as $row)

	            <tr>
                    <td>{{ $no }}</td>
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
                </tr>

	            @php
					$no++;
				@endphp

	            @endforeach
            </tbody>
        </table>

        <hr />

    </body>
</html>


