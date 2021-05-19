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

use App\Http\Controllers\aKunjungan;

class aKunjungan extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_kunjungan";
    	$this->prefix = "kunjungan";
    	$this->pagename = "Kunjungan";
    }

    public function list(Request $request)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
						->orderBy('kodekunjungan', 'desc')
						->get();

        return view("admin/$this->prefix/list", $data);
    }

	public function tambah(Request $request)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Tambah</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Tambah ". $this->pagename;
		$data['aksi'] = "acttambah";


		$kodeanggota = Cfilter::FilterString($request->input('kodeanggota'));

		$data['rows'] = DB::table("tbl_anggota")
                        ->where('kodeanggota', '=', $kodeanggota)
                        ->orWhere('useranggota', '=', $kodeanggota)
                        ->first();

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        return view("admin/$this->prefix/tambah", $data);
    }

    public function acttambah(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
            $kodekunjungan = Csql::generateKode2("kodekunjungan", date("Ymd")."-KUNJUNGAN", $this->baseTable);
            $waktu = Cfilter::FilterString($request->input('waktu'));

            if($waktu == "waktu_datang")
            {
            	DB::table($this->baseTable)->insert([[
	                'kodekunjungan' => Cfilter::FilterString($kodekunjungan),
	                'kodeadmin' => Cfilter::FilterString(session("kodeadmin")),
	                'kodeanggota' => Cfilter::FilterString($request->input('kodeanggota')),
	                'waktudatang' => Cfilter::FilterString(date("Y-m-d H:i:s")),
	                'dateaddkunjungan' => Cfilter::FilterString(date("Y-m-d H:i")),
				]]);
            }
            else
            {
            	DB::table($this->baseTable)->insert([[
	                'kodekunjungan' => Cfilter::FilterString($kodekunjungan),
	                'kodeadmin' => Cfilter::FilterString(session("kodeadmin")),
	                'kodeanggota' => Cfilter::FilterString($request->input('kodeanggota')),
	                'waktupulang' => Cfilter::FilterString(date("Y-m-d H:i:s")),
	                'dateaddkunjungan' => Cfilter::FilterString(date("Y-m-d H:i")),
				]]);
            }


			

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aKunjungan::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('kodeanggota')."</b>");
		return redirect()->action([aKunjungan::class, 'tambah'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodeinformasi'));

			// update user
			DB::table($this->baseTable)
	            ->where('kodeinformasi', "=", $id)
	            ->update
	            ([
		            'judulinformasi' => Cfilter::FilterString($request->input('judulinformasi')),
		            'isiinformasi' => $request->input('isiinformasi'),
                	'dateupdinformasi' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aKunjungan::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodeinformasi')."</b>");
		return redirect()->action([aKunjungan::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
        	DB::table($this->baseTable)
	            ->where('kodeinformasi', "=", $id)
	            ->update
	            ([
		            'statusinformasi' => Cfilter::FilterInt(2),
	            ]);

            // DB::table($this->baseTable)
            //     ->where('kodeinformasi', '=', $id)
            //     ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aKunjungan::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aKunjungan::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

    
}
?>
