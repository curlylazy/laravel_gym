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

use App\Http\Controllers\fInformasi;

class fInformasi extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_informasi";
    	$this->prefix = "informasi";
    	$this->pagename = "Informasi";
    }

    public function list(Request $request)
    {
        // Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

        $rows = DB::table($this->baseTable)
                ->join('tbl_admin', 'tbl_admin.kodeadmin', '=', 'tbl_informasi.kodeadmin')
                ->where('tbl_informasi.statusinformasi', '=', 1)
                ->simplePaginate(8);

        $data['paging_transaksi'] = $rows;
        $data['rows'] = $rows;

        return view("front/$this->prefix/list", $data);
    }

    public function detail($id)
    {
        $this->middleware('cekloginfront');

        $data['rows'] = DB::table($this->baseTable)
                        ->join('tbl_admin', 'tbl_admin.kodeadmin', '=', 'tbl_informasi.kodeadmin')
                        ->where('tbl_informasi.kodeinformasi', '=', $id)
                        ->first();

        // Judul Halaman
        $data['prefix'] = $this->prefix;

        // paramerter error
        $data['pesaninfo'] = "";
        $data['iserror'] = false;

        return view("front/$this->prefix/detail", $data);
    }
}
?>
