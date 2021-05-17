<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cview
{
	const LapAlamat = 'Jalan Seminyak, Badung No 90';
	const LapTelp = '0899292929';

	public static function menuDashboard($icon, $subname, $name, $keterangan, $prefix, $col)
    {
        /*<div class='col-md-$col'>
			<div class='info-box bg-aqua'>
				<span class='info-box-icon'><i class='$icon'></i></span>
				<div class='info-box-content'>
					<span class='info-box-number'>$nama</span>
					<span class='info-box-text'>$keterangan</span>
					<div class='progress'>
						<div class='progress-bar' style='width: 70%'></div>
					</div>
					<span class='progress-description'>
						<a href='".url("admin/$prefix/tambah")."' class='btn btn-primary btn-flat btn-xs'><i class='fa fa-plus'></i> Tambah $prefix</a>
						<a href='".url("admin/$prefix/list")."' class='btn btn-primary btn-flat btn-xs'><i class='fa fa-list'></i> List $prefix</a>
					</span>
				</div>
			</div>
		</div>*/

        $iMenu = "
		<div class='col-lg-3 col-sm-6'>
			<div class='card'>
				<div class='content'>
					<div class='row'>
						<div class='col-xs-5'>
							<div class='icon-big icon-warning text-center'>
								<i class='$icon'></i>
							</div>
						</div>
						<div class='col-xs-7'>
							<div class='numbers'>
								<p>$subname</p>
								$name
							</div>
						</div>
					</div>
					<div class='footer'>
						<hr />
						<div class='stats'>
							<a href='".url("admin/$prefix/tambah")."'><i class='ti-reload'></i> Go to menu</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		";

		return $iMenu;
    }

	public static function pesanSukses($pesan)
	{
		$iPesan = "";
		$iPesan = "<div class='alert alert-success alert-dismissable'>
				   <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> $pesan </div>";

		return $iPesan;
	}

	public static function pesanGagal($pesan)
	{
		$iPesan = "";
		$iPesan = "<div class='alert alert-danger alert-dismissable'>
		           <button type='button' class='close' aria-label='Close' data-dismiss='alert' aria-hidden='true'>×</button> $pesan</div>";

		return $iPesan;
	}

	public static function tampilDropDown($tabel, $value, $display)
	{
		$iOption = array();

		$result = DB::table($tabel)
					->select('*')
					->pluck($value, $display);

		$iOption[] = "<option value=''>-- Pilih Data --</option>";

		foreach ($result as $display => $value)
		{
			$iOption[] = "<option value='$value'>[$value] - $display</option>";
		}

		$iOption = join($iOption, "");
		return $iOption;
	}

	public static function tampilDropDownSatuan()
	{
		$iOption = array();
		$iOption[] = "<option value=''>-- Pilih Data --</option>";
		$iOption[] = "<option value='KG'>KG</option>";
		$iOption[] = "<option value='Gram'>Gram</option>";

		$iOption = join($iOption, "");
		return $iOption;
	}

	public static function tampilDropDownBank()
	{
		$iOption = array();
		$iOption[] = "<option value=''>-- Pilih Data --</option>";
		$iOption[] = "<option value='BCA'>BCA</option>";
		$iOption[] = "<option value='BNI'>BNI</option>";
		$iOption[] = "<option value='BRI'>BRI</option>";
		$iOption[] = "<option value='BTN'>BTN</option>";
		$iOption[] = "<option value='BPD Bali'>BPD Bali</option>";
		$iOption[] = "<option value='CIMB Niaga'>CIMB Niaga</option>";

		$iOption = join($iOption, "");
		return $iOption;
	}

	public static function tampilDropDownItem($kodenelayan)
    {
        $rows = DB::table("tbl_item")
                ->select('*')
                ->where('kodenelayan', "=", $kodenelayan)
                ->get();

        $temp = "";

        $temp .= "<option value=''>Pilih..</option>";

        foreach ($rows as $row)
        {
            $temp .= "<option value='".$row->kodeitem."'>".$row->namaitem." [".$row->satuan."]</option>";
        }

        return $temp;
    }

    public static function tampilDropDownKabupaten()
	{
		$iOption = array();
		$iOption[] = "<option value=''>-- Pilih Kabupaten --</option>";
		$iOption[] = "<option value='Badung'>Badung</option>";
		$iOption[] = "<option value='Bangli'>Bangli</option>";
		$iOption[] = "<option value='Buleleng'>Buleleng</option>";
		$iOption[] = "<option value='Gianyar'>Gianyar</option>";
		$iOption[] = "<option value='Jembrana'>Jembrana</option>";
		$iOption[] = "<option value='Karangasem'>Karangasem</option>";
		$iOption[] = "<option value='Klungkung'>Klungkung</option>";
		$iOption[] = "<option value='Tabanan'>Tabanan</option>";
		$iOption[] = "<option value='Denpasar'>Denpasar</option>";

		$iOption = join($iOption, "");
		return $iOption;
	}

	public static function StatusAnggota($val)
	{
		$iRes = "";

		if($val == '0')
			$iRes = "Pending";

		elseif($val == '1')
			$iRes = "Aktif";

		elseif($val == '2')
			$iRes = "Ditolak";

		elseif($val == '5')
			$iRes = "Tidak Aktif";

		return $iRes;
	}

}
