<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Lib\Cfilter;

class Csql
{
	public static function addDayswithdate($date, $days)
	{
	    $date = strtotime("+".$days." days", strtotime($date));
	    return  date("Y-m-d", $date);
	}

    public static function generateFakeID($prefix, $numkode)
    {
        // parsing kode
        $nilaikode = substr($numkode, strlen($prefix));
        $kode = (int) $nilaikode;
        $kode = $kode + $numkode;
        $hasilkode = $prefix.str_pad($kode, 4, "0", STR_PAD_LEFT);

        return $hasilkode;
    }

	public static function generateKode($prefix, $table)
    {

		// ambil max data counter
    	$datakode = DB::table("tbl_counter")
					->where("tabel", $table)
					->max('counter');

    	if($datakode == "")
    	{
    		$hasilkode = $prefix."0001";

			// simpan ke tbl_counter
			DB::table("tbl_counter")->insert([[
		    	'tabel' => $table,
				'counter' => $hasilkode
			]]);
    	}

    	else
    	{
			// parsing kode
    		$nilaikode = substr($datakode, strlen($prefix));
    		$kode = (int) $nilaikode;
			$kode = $kode + 1;
			$hasilkode = $prefix.str_pad($kode, 4, "0", STR_PAD_LEFT);

			// update data counter
			DB::table("tbl_counter")
            ->where('tabel', "=", $table)
            ->update
            ([
                'counter' => $hasilkode,
            ]);
    	}

    	return $hasilkode;

    }

    public static function generateKode2($kode, $param, $table)
	{

		if($kode =="" || $param == "" || $table == "")
		{
			echo "Tidak dapat menggenerate data Kode Otomatis";
			return;
		}

		$autonum = "";
		$value	 = "";

        $nomer = DB::table($table)
					->max($kode);

		$autonum = $nomer;

		# Cek Parameter
		if($autonum == "")
		{
			$autonum = $param."001";
		}
		else
		{
			$autonum = (int) substr($autonum, strlen($param), 4);
			$autonum++;
			$autonum =  $param.sprintf("%03s", $autonum);
		}

		return $autonum;
	}

	public static function cariData($table, $field, $value)
    {
    	$hasil = DB::table($table)->where($field, $value)->first();

        if(empty($data->$hasil))
        {
            $hasil = "";
            return;
        }

        return $hasil;
    }

	public static function cariData2($get, $field, $value, $tabel)
    {
    	$iRes = "";
        $data = DB::table($tabel)
                ->select($get)
                ->where($field, '=', $value)
                ->first();

        if(empty($data->$get))
        {
        	$iRes = "";
        	return $iRes;
        }

		$iRes = $data->$get;
    	return $iRes;

    // 	$iRes = "";
    //     $sql = "SELECT * FROM $tabel
				// WHERE $field = '$value'";

    //     $results = DB::select(DB::raw($sql));

    //     if(empty($results[0]->$get))
    //     {
    //     	$iRes = "";
    //     	return $iRes;
    //     }

    //     $iRes = $results[0]->$get;
    //     return $iRes;

    }

    public static function getRows($field, $value, $tabel)
    {
        $iRes = "";
        $data = DB::table($tabel)
                ->where($field, '=', $value)
                ->first();

        if(empty($data->$field))
        {
            $iRes = "";
            return $iRes;
        }

        $iRes = $data;
        return $iRes;
    }

    public static function getTotalBayarByToko($kodenelayan, $kodepelanggan)
    {
    	$sql = "SELECT SUM(tbl_cart.subtotal) as total FROM tbl_cart
				WHERE 
                    tbl_cart.kodenelayan = '$kodenelayan'
				    AND tbl_cart.kodepelanggan = '$kodepelanggan'";

        $results = DB::select(DB::raw($sql));

        return $results[0]->total;
    }

    public static function DropDown($value, $display, $tabel)
    {
        $rows = DB::table($tabel)
                ->select('*')
                ->get();

        $temp = "";

        $temp .= "<option value=''>Pilih..</option>";

        foreach ($rows as $row)
        {
			$temp .= "<option value='".$row->$value."'>".$row->$display."</option>";
		}

        return $temp;
    }

    public static function DropDownStatus($value, $display, $tabel, $statusfield)
    {
        $rows = DB::table($tabel)
                ->select('*')
                ->where($statusfield, "=", 1)
                ->get();

        $temp = "";

        $temp .= "<option value=''>Pilih..</option>";

        foreach ($rows as $row)
        {
            $temp .= "<option value='".$row->$value."'>".$row->$display."</option>";
        }

        return $temp;
    }

	public static function addlog($tabel, $aksi, $kode)
    {
		DB::table("tbl_log")->insert([[
            'user' => Cfilter::FilterString(session('kodeadmin')),
            'tabel' => Cfilter::FilterString($tabel),
            'aksi' => Cfilter::FilterString($aksi),
            'kode' => Cfilter::FilterString($kode),
            'datelog' => Cfilter::FilterString(date("Y-m-d H:i")),
        ]]);
    }

    public static function getTotalItemInCart()
    {
        $kodepelanggan = session('kodepelanggan');

        $sql = "SELECT COUNT(*) as total FROM tbl_cart
                WHERE kodepelanggan = '$kodepelanggan'";

        $results = DB::select(DB::raw($sql));

        if(empty($results[0]->total))
        {
            $iRes = 0;
        }
        else
        {
            $iRes = $results[0]->total;
        }

        return $iRes;
    }

    public static function cekItemInCart($kodeitem)
    {
        $kodepelanggan = session('kodepelanggan');

        $sql = "SELECT COUNT(*) as total FROM tbl_cart
                WHERE kodeitem = '$kodeitem' AND kodepelanggan = '$kodepelanggan'";

        $results = DB::select(DB::raw($sql));

        if(empty($results[0]->total))
        {
            $iRes = 0;
        }
        else
        {
            $iRes = $results[0]->total;
        }

        return $iRes;
    }

    public static function getItemInCartByToko($kodenelayan, $kodepelanggan)
    {
        $iRes = "";
        $sql = "SELECT * FROM tbl_cart
                INNER JOIN tbl_item ON (tbl_item.kodeitem = tbl_cart.kodeitem)
                WHERE (tbl_cart.kodenelayan = '".$kodenelayan."' AND tbl_cart.kodepelanggan = '".$kodepelanggan."')";

        $rows = DB::select(DB::raw($sql));

        $temp = "";

        foreach ($rows as $row)
        {
            $namaitem = $row->namaitem;
            $jumlah = $row->jumlah;
            $satuan = $row->satuan;
            $hargaitem = number_format($row->hargaitem);
            $subtotal = number_format($row->subtotal);

            $temp .= "$namaitem : $jumlah x $hargaitem/$satuan = $subtotal <br />";
        }

        $iRes = $temp;
        return $iRes;
    }

    public static function getItemInTransaksiByToko($kodetransaksi)
    {
        $iRes = "";
        $sql = "SELECT * FROM tbl_transaksi_dt
                INNER JOIN tbl_item ON (tbl_item.kodeitem = tbl_transaksi_dt.kodeitem)
                WHERE (tbl_transaksi_dt.kodetransaksi = '".$kodetransaksi."')";

        $rows = DB::select(DB::raw($sql));

        $temp = "";

        foreach ($rows as $row)
        {
            $namaitem = $row->namaitem;
            $jumlah = $row->jumlahitem;
            $satuan = $row->satuan;
            $hargaitem = number_format($row->hargaitem);
            $subtotal = number_format($row->subtotal);

            $temp .= "$namaitem : $jumlah x $hargaitem/$satuan = $subtotal <br />";
        }

        $iRes = $temp;
        return $iRes;
    }

    public static function cekStatusKonfirmasi($status)
    {
        $iRes = "";

        if($status == 0)
            $iRes = "Pending";
        elseif($status == 1)
            $iRes = "Menunggu Validasi";
        elseif($status == 2)
            $iRes = "Berhasil";
        elseif($status == 3)
            $iRes = "Sudah Diambil";
        elseif($status == 9)
            $iRes = "Ditolak";

        return $iRes;
    }

    public static function UpdateStok($kodeitem, $jumlahitem)
    {
        // echo "$kodeitem";
        $stokLama = intval(self::cariData2("stokitem", "kodeitem", $kodeitem, "tbl_item"));
        $stokBaru = intval($stokLama + $jumlahitem);

        DB::table("tbl_item")
        ->where('kodeitem', "=", $kodeitem)
        ->update
        ([
            'stokitem' => $stokBaru
        ]);
    }

    public static function UpdateStokUpd($kodeitemmasuk, $jmlNew)
    {

        $row = self::getRows("kodeitemmasuk", $kodeitemmasuk, "tbl_item_masuk");

        $kodeitem = $row->kodeitem;
        $jumlahOld = intval($row->jumlahitem);

        $stokLama = intval(self::cariData2("stokitem", "kodeitem", $kodeitem, "tbl_item"));
        $stokBaru = $stokLama + $jmlNew - $jumlahOld;
        
        DB::table("tbl_item")
        ->where('kodeitem', "=", $kodeitem)
        ->update
        ([
            'stokitem' => $stokBaru
        ]);
    }

    public static function CekStokGlobalByJenisItem($kodejenisitem)
    {
        // satuan hanya ada KG / GRAM saja
        // agar bisa dikonversikan ke satuan utama yakni KG

        $iRes = "";
        $sql = "SELECT * FROM tbl_item
                WHERE kodejenisitem = '$kodejenisitem'";

        $rows = DB::select(DB::raw($sql));

        $stokglobal = 0;

        foreach ($rows as $row)
        {
            $satuan = $row->satuan;
            $stokitem = $row->stokitem;

            if($satuan == 'Gram')
            {
                $stokitem = $stokitem / 1000;
            }

            $stokglobal = $stokglobal + $stokitem;
        }

        $iRes = $stokglobal;
        return $iRes;
    }

    public static function GetKabupatenID($namakabupaten)
    {
        $iRes = "";

        if($namakabupaten == "Badung")
            $iRes = 17;
        elseif($namakabupaten == "Bangli")
            $iRes = 32;
        elseif($namakabupaten == "Buleleng")
            $iRes = 94;
        elseif($namakabupaten == "Denpasar")
            $iRes = 114;
        elseif($namakabupaten == "Gianyar")
            $iRes = 128;
        elseif($namakabupaten == "Jembrana")
            $iRes = 161;
        elseif($namakabupaten == "Karangasem")
            $iRes = 170;
        elseif($namakabupaten == "Klungkung")
            $iRes = 197;
        elseif($namakabupaten == "Tabanan")
            $iRes = 447;

        return $iRes;
    }

}
