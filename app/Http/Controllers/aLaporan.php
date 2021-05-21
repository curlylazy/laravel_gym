<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

// load library
use App\Lib\Csql;
use App\Lib\Cupload;
use App\Lib\Cfilter;
use App\Lib\Cview;

use PDF;

class aLaporan extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->prefix = "laporan";
    	$this->pagename = "Laporan";
    }

    // ================= ANGGOTA ===================================
    public function anggota(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

		$data['katakunci'] = $katakunci;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Anggota";

		$this->baseTable = "tbl_anggota";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->where('tbl_anggota.namaanggota', 'like', "%$katakunci%")
                        ->where('tbl_anggota.useranggota', 'like', "%$katakunci%")
                        ->where('tbl_anggota.statusanggota', '=', 1)
						->orderBy('tbl_anggota.kodeanggota', 'desc')
						->get();

        return view("admin/$this->prefix/anggota", $data);
    }

    public function cetak_anggota(Request $request)
    {
        $katakunci = Cfilter::FilterString($request->input('katakunci'));

        $data['judul'] = "Laporan Anggota";

        $data['keterangan'] = "";

        if(!empty($katakunci))
        {
            $data['keterangan'] = "katakunci : $katakunci <br />";
        }

        $data['keterangan'] .= "laporan cetak pelanggan Tiger Gym.";

        $this->baseTable = "tbl_anggota";

        // passing function ke view
        $rows = DB::table($this->baseTable)
                ->select('*')
                ->where('tbl_anggota.namaanggota', 'like', "%$katakunci%")
                ->where('tbl_anggota.useranggota', 'like', "%$katakunci%")
                ->where('tbl_anggota.statusanggota', '=', 1)
                ->orderBy('tbl_anggota.kodeanggota', 'desc')
                ->get();

        $data['rows'] = $rows;

        $pdf = PDF::loadView('admin/laporan/cetak_anggota', $data)
               ->setPaper('a4', 'landscape');

        return $pdf->stream();
    }

    // ================= END ===================================

    // ================= KUNJUNGAN ===================================

    public function kunjungan(Request $request)
    {
        $katakunci = Cfilter::FilterString($request->input('katakunci'));
        $tanggaldari = Cfilter::FilterString($request->input('tanggaldari'));
        $tanggalsampai = Cfilter::FilterString($request->input('tanggalsampai'));

        if(empty($tanggaldari))
        {
            $tanggaldari = date("Y-m-01");
        }

        if(empty($tanggalsampai))
        {
            $tanggalsampai = date("Y-m-t");
        }

        // breadcrumb
        $breadcrumb = array();
        $breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
        $breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
        $breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
        $data['breadcrumb'] = join($breadcrumb, "");

        // Judul Halaman
        $data['prefix'] = $this->prefix;
        $data['pagename'] = "Laporan Anggota";

        $this->baseTable = "tbl_kunjungan";

        // passing function ke view
        $data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->join('tbl_anggota', 'tbl_anggota.kodeanggota', '=', 'tbl_kunjungan.kodeanggota')
                        ->join('tbl_admin', 'tbl_admin.kodeadmin', '=', 'tbl_kunjungan.kodeadmin')
                        ->where('tbl_anggota.namaanggota', 'like', "%$katakunci%")
                        ->where('tbl_anggota.useranggota', 'like', "%$katakunci%")
                        ->whereBetween('tbl_kunjungan.dateaddkunjungan', [$tanggaldari, $tanggalsampai])
                        ->orderBy('tbl_kunjungan.kodekunjungan', 'desc')
                        ->get();

        $data['katakunci'] = $katakunci;
        $data['tanggaldari'] = $tanggaldari;
        $data['tanggalsampai'] = $tanggalsampai;

        return view("admin/$this->prefix/kunjungan", $data);
    }

    // ================= END ===================================






















    public function pelanggan(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

		$data['katakunci'] = $katakunci;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Pelanggan";

		$this->baseTable = "tbl_pelanggan";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->where('tbl_pelanggan.namapelanggan', 'like', "%$katakunci%")
						->orderBy('tbl_pelanggan.kodepelanggan', 'desc')
						->get();

        return view("admin/$this->prefix/pelanggan", $data);
    }

    public function item(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

		$data['katakunci'] = $katakunci;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Item";

		$this->baseTable = "tbl_item";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                        ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_item.kodenelayan')
                        ->where('tbl_item.namaitem', 'like', "%$katakunci%")
						->orderBy('tbl_item.kodeitem', 'desc')
						->get();

        return view("admin/$this->prefix/item", $data);
    }

    public function transaksi(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));
    	$tgltransaksi_dari = Cfilter::FilterString($request->input('tgltransaksi_dari'));
		$tgltransaksi_sampai = Cfilter::FilterString($request->input('tgltransaksi_sampai'));

		if(empty($tgltransaksi_dari))
		{
			$tgltransaksi_dari = date("Y-m-01");
		}

		if(empty($tgltransaksi_sampai))
		{
			$tgltransaksi_sampai = date("Y-m-t");
		}

		$data['katakunci'] = $katakunci;
		$data['tgltransaksi_dari'] = $tgltransaksi_dari;
		$data['tgltransaksi_sampai'] = $tgltransaksi_sampai;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Transaksi";

		$this->baseTable = "tbl_transaksi_hd";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
		                ->join('tbl_pelanggan', 'tbl_pelanggan.kodepelanggan', '=', 'tbl_transaksi_hd.kodepelanggan')
		                ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_transaksi_hd.kodenelayan')
		                ->whereIn('tbl_transaksi_hd.konfirmasi_status', [2, 3])
		                ->where('tbl_transaksi_hd.kodetransaksi', 'like', "%$katakunci%")
		                ->whereBetween('tbl_transaksi_hd.dateaddtransaksi', [$tgltransaksi_dari, $tgltransaksi_sampai])
						->get();

        return view("admin/$this->prefix/transaksi", $data);
    }

    

    public function cetak_nelayan(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

    	$data['judul'] = "Laporan Nelayan";

    	$data['keterangan'] = "";

    	if(!empty($katakunci))
    	{
    		$data['keterangan'] = "katakunci : $katakunci <br />";
    	}

    	$data['keterangan'] .= "laporan cetak pelanggan Pengambengan.";

    	$this->baseTable = "tbl_nelayan";

    	// passing function ke view
		$rows = DB::table($this->baseTable)
                ->select('*')
                ->where('tbl_nelayan.namanelayan', 'like', "%$katakunci%")
				->orderBy('tbl_nelayan.kodenelayan', 'desc')
				->get();

        $data['rows'] = $rows;

    	$pdf = PDF::loadView('admin/laporan/cetak_nelayan', $data)
               ->setPaper('a4', 'landscape');

		return $pdf->stream();
    }

    public function cetak_item(Request $request)
    {
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

    	$data['judul'] = "Laporan Item";

    	$data['keterangan'] = "";

    	if(!empty($katakunci))
    	{
    		$data['keterangan'] = "katakunci : $katakunci <br />";
    	}

    	$data['keterangan'] .= "laporan cetak item Pengambengan.";

    	$this->baseTable = "tbl_item";

    	// passing function ke view
		$rows = DB::table($this->baseTable)
		        ->select('*')
                ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_item.kodenelayan')
				->orderBy('tbl_item.kodeitem', 'desc')
		        ->get();

        $data['rows'] = $rows;

    	$pdf = PDF::loadView('admin/laporan/cetak_item', $data)
               ->setPaper('a4', 'landscape');

		return $pdf->stream();
    }

    public function cetak_transaksi(Request $request)
    {

    	$katakunci = Cfilter::FilterString($request->input('katakunci'));
    	$tgltransaksi_dari = Cfilter::FilterString($request->input('tgltransaksi_dari'));
		$tgltransaksi_sampai = Cfilter::FilterString($request->input('tgltransaksi_sampai'));

    	$data['judul'] = "Laporan Transaksi";

    	$data['keterangan'] = "";

    	if(!empty($katakunci))
    	{
    		$data['keterangan'] = "katakunci : $katakunci <br />";
    	}

    	$tgltransaksi = date('d F Y', strtotime($tgltransaksi_dari))." s/d ".date('d F Y', strtotime($tgltransaksi_sampai));
    	$data['keterangan'] .= "laporan cetak transaksi Pengambengan. <br /> Tanggal Transaksi $tgltransaksi";

    	$this->baseTable = "tbl_transaksi_hd";

    	// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
		                ->join('tbl_pelanggan', 'tbl_pelanggan.kodepelanggan', '=', 'tbl_transaksi_hd.kodepelanggan')
		                ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_transaksi_hd.kodenelayan')
		                ->whereIn('tbl_transaksi_hd.konfirmasi_status', [2, 3])
		                ->where('tbl_transaksi_hd.kodetransaksi', 'like', "%$katakunci%")
		                ->whereBetween('tbl_transaksi_hd.dateaddtransaksi', [$tgltransaksi_dari, $tgltransaksi_sampai])
						->get();

    	$pdf = PDF::loadView('admin/laporan/cetak_transaksi', $data)
               ->setPaper('a4', 'landscape');

		return $pdf->stream();
    }





    // ================= NELAYAN ===================================
    public function item_nelayan(Request $request)
    {

    	$id = session('kodenelayan');
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

		$data['katakunci'] = $katakunci;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("nelayan/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Item";

		$this->baseTable = "tbl_item";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                        ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_item.kodenelayan')
                        ->where('tbl_item.kodenelayan', '=', $id)
                        ->where('tbl_item.namaitem', 'like', "%$katakunci%")
						->orderBy('tbl_item.kodeitem', 'desc')
						->get();

        return view("nelayan/$this->prefix/item", $data);
    }

    public function transaksi_nelayan(Request $request)
    {

    	$id = session('kodenelayan');
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));
    	$tgltransaksi_dari = Cfilter::FilterString($request->input('tgltransaksi_dari'));
		$tgltransaksi_sampai = Cfilter::FilterString($request->input('tgltransaksi_sampai'));

		if(empty($tgltransaksi_dari))
		{
			$tgltransaksi_dari = date("Y-m-01");
		}

		if(empty($tgltransaksi_sampai))
		{
			$tgltransaksi_sampai = date("Y-m-t");
		}

		$data['katakunci'] = $katakunci;
		$data['tgltransaksi_dari'] = $tgltransaksi_dari;
		$data['tgltransaksi_sampai'] = $tgltransaksi_sampai;

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("nelayan/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Laporan Transaksi";

		$this->baseTable = "tbl_transaksi_hd";

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
		                ->join('tbl_pelanggan', 'tbl_pelanggan.kodepelanggan', '=', 'tbl_transaksi_hd.kodepelanggan')
		                ->where('tbl_transaksi_hd.kodenelayan', '=', session('kodenelayan'))
		                ->whereIn('tbl_transaksi_hd.konfirmasi_status', [2, 3])
		                ->where('tbl_transaksi_hd.kodetransaksi', 'like', "%$katakunci%")
		                ->whereBetween('tbl_transaksi_hd.dateaddtransaksi', [$tgltransaksi_dari, $tgltransaksi_sampai])
						->get();

        return view("nelayan/$this->prefix/transaksi", $data);
    }

    public function cetak_transaksi_nelayan(Request $request)
    {

    	$id = session('kodenelayan');
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));
    	$tgltransaksi_dari = Cfilter::FilterString($request->input('tgltransaksi_dari'));
		$tgltransaksi_sampai = Cfilter::FilterString($request->input('tgltransaksi_sampai'));

    	$data['judul'] = "Laporan Transaksi";

    	$data['keterangan'] = "";

    	if(!empty($katakunci))
    	{
    		$data['keterangan'] = "katakunci : $katakunci <br />";
    	}

    	$tgltransaksi = date('d F Y', strtotime($tgltransaksi_dari))." s/d ".date('d F Y', strtotime($tgltransaksi_sampai));
    	$data['keterangan'] .= "laporan cetak transaksi Pengambengan. <br /> Tanggal Transaksi $tgltransaksi";

    	$this->baseTable = "tbl_transaksi_hd";

    	// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
		                ->join('tbl_pelanggan', 'tbl_pelanggan.kodepelanggan', '=', 'tbl_transaksi_hd.kodepelanggan')
		                ->where('tbl_transaksi_hd.kodenelayan', '=', session('kodenelayan'))
		                ->whereIn('tbl_transaksi_hd.konfirmasi_status', [2, 3])
		                ->where('tbl_transaksi_hd.kodetransaksi', 'like', "%$katakunci%")
		                ->whereBetween('tbl_transaksi_hd.dateaddtransaksi', [$tgltransaksi_dari, $tgltransaksi_sampai])
						->get();

    	$pdf = PDF::loadView('nelayan/laporan/cetak_transaksi', $data)
               ->setPaper('a4', 'landscape');

		return $pdf->stream();
    }

    public function cetak_item_nelayan(Request $request)
    {

    	$id = session('kodenelayan');
    	$katakunci = Cfilter::FilterString($request->input('katakunci'));

    	$data['judul'] = "Laporan Item";

    	$data['keterangan'] = "";

    	if(!empty($katakunci))
    	{
    		$data['keterangan'] = "katakunci : $katakunci <br />";
    	}

    	$data['keterangan'] .= "laporan cetak item Pengambengan.";

    	$this->baseTable = "tbl_item";

    	// passing function ke view
		$rows = DB::table($this->baseTable)
		        ->select('*')
                ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_item.kodenelayan')
                ->where('tbl_item.kodenelayan', '=', $id)
				->orderBy('tbl_item.kodeitem', 'desc')
		        ->get();

        $data['rows'] = $rows;

    	$pdf = PDF::loadView('nelayan/laporan/cetak_item', $data)
               ->setPaper('a4', 'landscape');

		return $pdf->stream();
    }


    

}
?>
