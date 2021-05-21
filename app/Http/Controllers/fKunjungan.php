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

use App\Http\Controllers\fKunjungan;

class fKunjungan extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_kunjungan";
    	$this->prefix = "kunjungan";
    	$this->pagename = "Kunjungan";
    }

    public function actsetfilter(Request $request)
    {
        // filter
        $tanggaldari = Cfilter::FilterString($request->input('tanggaldari'));
        $tanggalsampai = Cfilter::FilterString($request->input('tanggalsampai'));

        if(isset($tanggaldari))
        {
            session(['tanggaldari' => $tanggaldari]);
        }

        if(isset($tanggalsampai))
        {
            session(['tanggalsampai' => $tanggalsampai]);
        }

        return redirect()->action([fKunjungan::class, 'list']);
    }

    public function list(Request $request)
    {
        // Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

        $tanggaldari = session('tanggaldari');
        $tanggalsampai = session('tanggalsampai');

        if(empty($tanggaldari))
        {
            $tanggaldari = date("Y-m-01");
        }

        if(empty($tanggalsampai))
        {
            $tanggalsampai = date("Y-m-t");
        }

        

        $rows = DB::table($this->baseTable)
                ->join('tbl_admin', 'tbl_admin.kodeadmin', '=', 'tbl_kunjungan.kodeadmin')
                ->whereBetween('tbl_kunjungan.dateaddkunjungan', [$tanggaldari, $tanggalsampai])
                ->orderBy('tbl_kunjungan.kodekunjungan', 'desc')
                ->simplePaginate(8);

        $data['rows'] = $rows;
        $data['tanggaldari'] = $tanggaldari;
        $data['tanggalsampai'] = $tanggalsampai;

        return view("front/$this->prefix/list", $data);
    }

}
?>
