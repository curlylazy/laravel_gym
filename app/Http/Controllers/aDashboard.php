<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

// load library
use App\Lib\Csql;
use App\Lib\Cupload;
use App\Lib\Cfilter;
use App\Lib\Cview;

class aDashboard extends Controller
{
	public function __construct()
    {
        
    }

    public function index()
    {
    	$this->middleware('ceklogin');
    	
		// nama title
    	$data['pagename'] = "Dashboard";

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		$data['jml_anggota'] = DB::table('tbl_anggota')
							->count();

		$data['jml_informasi'] = DB::table('tbl_informasi')
							   ->count();

		$data['jml_alat_gym'] = DB::table('tbl_alat_gym')
							   ->count();

		$data['jml_konfirmasi'] = DB::table('tbl_konfirmasi')
							->whereIn('statuskonfirmasi', [0, 2])
							->count();

		$data['jml_kunjungan'] = DB::table('tbl_kunjungan')
							->where(DB::raw("(DATE_FORMAT(dateaddkunjungan,'%Y-%m'))"), date("Y-m"))
							->count();

        return view('admin/dashboard/dashboardmenu', $data);
    }


    // NELAYAN =================================================

    public function index_nelayan()
    {
		// nama title
    	$data['pagename'] = "Dashboard";

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['headname'] = "Halaman Dashboard";
		$data['description'] = "berikut ini adalah halaman dashboard";

		$id = session('kodenelayan');

		// nama title
    	$data['pagename'] = "Dashboard";

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['headname'] = "Halaman Dashboard";
		$data['description'] = "berikut ini adalah halaman dashboard";

		$data['jml_item'] = DB::table('tbl_item')
							->where('kodenelayan', '=', $id)
							->count();

		$data['jml_transaksi'] = DB::table('tbl_transaksi_hd')
							->where('kodenelayan', '=', $id)
							->whereIn('konfirmasi_status', [2, 3])
							->count();

		$data['jml_transaksi_menunggu_validasi'] = DB::table('tbl_transaksi_hd')
							->where('kodenelayan', '=', $id)
							->where('konfirmasi_status', '=', 1)
							->count();

		// total penjualan bulan ini
		$data['total_penjualan_bulan_ini'] = DB::table('tbl_transaksi_hd')
							->where('kodenelayan', '=', $id)
							->where(DB::raw("(DATE_FORMAT(dateaddtransaksi,'%Y-%m'))"), date("Y-m"))
							->whereIn('konfirmasi_status', [2, 3])
							->count();

		$data['total_pendapatan_bulan_ini'] = DB::table('tbl_transaksi_hd')
							->where('kodenelayan', '=', $id)
							->where(DB::raw("(DATE_FORMAT(dateaddtransaksi,'%Y-%m'))"), date("Y-m"))
							->whereIn('konfirmasi_status', [2, 3])
							->sum('tbl_transaksi_hd.totaltransaksi');

        return view('nelayan/dashboard/dashboardmenu', $data);
    }
}
?>
