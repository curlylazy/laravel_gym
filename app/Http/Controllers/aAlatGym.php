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

use App\Http\Controllers\aAlatGym;

class aAlatGym extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_alat_gym";
    	$this->prefix = "alatgym";
    	$this->pagename = "Alat Gym";
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
                        ->where('statusalatgym', '=', 1)
						->orderBy('tbl_alat_gym.kodealatgym', 'desc')
						->get();

        return view("admin/$this->prefix/list", $data);
    }

	public function tambah()
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

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        return view("admin/$this->prefix/tambah", $data);
    }

    public function edit($id)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/master/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Edit</li>";
		$breadcrumb []= "<li class='breadcrumb-item'><b>$id</b></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;
		$data['aksi'] = "actedit";

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
                        ->where('kodealatgym', '=', $id)
                        ->first();

        return view("admin/$this->prefix/tambah", $data);
    }

    public function acttambah(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
            $kodealatgym = Csql::generateKode2("kodealatgym", date("Ymd")."-ALATGYM", $this->baseTable);

            $gambaralatgym = Cupload::UploadGambar('gambaralatgym', '', $request);

			DB::table($this->baseTable)->insert([[
                'kodealatgym' => Cfilter::FilterString($kodealatgym),
                'kodeadmin' => Cfilter::FilterString(session("kodeadmin")),
                'namaalatgym' => Cfilter::FilterString($request->input('namaalatgym')),
                'keteranganalatgym' => $request->input('keteranganalatgym'),
                'gambaralatgym' => $gambaralatgym,
                'statusalatgym' => 1,
                'dateaddalatgym' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdalatgym' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('kodealatgym')."</b>");
		return redirect()->action([aAlatGym::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodealatgym'));
			$gambaralatgym_old = Csql::cariData2('gambaralatgym', 'kodealatgym', $id, $this->baseTable);
			$gambaralatgym = Cupload::UploadGambar('gambaralatgym', $gambaralatgym_old, $request);

			// update user
			DB::table($this->baseTable)
	            ->where('kodealatgym', "=", $id)
	            ->update
	            ([
	            	'kodeadmin' => Cfilter::FilterString(session("kodeadmin")),
		            'namaalatgym' => Cfilter::FilterString($request->input('namaalatgym')),
		            'keteranganalatgym' => $request->input('keteranganalatgym'),
                	'gambaralatgym' => $gambaralatgym,
                	'dateupdalatgym' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodealatgym')."</b>");
		return redirect()->action([aAlatGym::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
        	DB::table($this->baseTable)
	            ->where('kodealatgym', "=", $id)
	            ->update
	            ([
		            'statusalatgym' => Cfilter::FilterInt(2),
	            ]);

            // DB::table($this->baseTable)
            //     ->where('kodealatgym', '=', $id)
            //     ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aAlatGym::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

    
}
?>
