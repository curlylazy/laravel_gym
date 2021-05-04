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
                        ->where('akses', '=', 'STAFF')
                        ->where('statusalatgym', '=', 1)
						->orderBy('tbl_item.kodeitem', 'desc')
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
                        ->where('kodeitem', '=', $id)
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
                'namaalatgym' => Cfilter::FilterString($request->input('namaalatgym')),
                'keteranganalatgym' => $request->input('keteranganalatgym'),
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
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('kodeitem')."</b>");
		return redirect()->action([aAlatGym::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodealatgym'));
			$gambaralatgym_old = Csql::cariData2('gambaralatgym', 'kodealatgym', $id, $this->baseTable);
			$gambaralatgym = Cupload::UploadGambar('gambaralatgym', $gambaritem_old, $request);

			// update user
			DB::table($this->baseTable)
	            ->where('kodeitem', "=", $id)
	            ->update
	            ([
		            'kodejenisitem' => Cfilter::FilterString($request->input('kodejenisitem')),
	                'namaitem' => Cfilter::FilterString($request->input('namaitem')),
	                'satuan' => Cfilter::FilterString($request->input('satuan')),
	                'hargaitem' => Cfilter::FilterInt($request->input('hargaitem')),
	                'namaitem' => Cfilter::FilterString($request->input('namaitem')),
	                'keteranganitem' => Cfilter::FilterString($request->input('keteranganitem')),
	                'gambaritem' => Cfilter::FilterString($gambaritem),
	                'dateadditem' => Cfilter::FilterString(date("Y-m-d H:i")),
                	'dateupditem' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodeitem')."</b>");
		return redirect()->action([aAlatGym::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
            DB::table($this->baseTable)
                ->where('kodeitem', '=', $id)
                ->delete();

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







    // =================== NELAYAN
    public function list_nelayan(Request $request)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("nelayan/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>$this->pagename</li>";
		$breadcrumb []= "<li class='breadcrumb-item active'>List</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

		// passing function ke view
		$data['rows'] = DB::table($this->baseTable)
                        ->select('*')
                        ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                        ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_item.kodenelayan')
                        ->where('tbl_nelayan.kodenelayan', '=', session('kodenelayan'))
						->orderBy('tbl_item.kodeitem', 'desc')
						->get();

        return view("nelayan/$this->prefix/list", $data);
    }

	public function tambah_nelayan()
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'>Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/master/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Tambah</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = "Tambah ". $this->pagename;
		$data['aksi'] = "acttambah";

		$data['listjenisitem'] = Cview::tampilDropDown("tbl_jenis_item", "kodejenisitem", "namajenisitem");
		$data['listnelayan'] = Cview::tampilDropDown("tbl_nelayan", "kodenelayan", "namanelayan");
		$data['listsatuan'] = CView::tampilDropDownSatuan();

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        return view("nelayan/$this->prefix/tambah", $data);
    }

    public function edit_nelayan($id)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("nelayan/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("nelayan/$this->prefix/list")."'>$this->pagename</a></li>";
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

		$data['listjenisitem'] = Cview::tampilDropDown("tbl_jenis_item", "kodejenisitem", "namajenisitem");
		$data['listsatuan'] = CView::tampilDropDownSatuan();

        $data['rows'] = DB::table($this->baseTable)
                        ->where('kodeitem', '=', $id)
                        ->first();

        return view("nelayan/$this->prefix/tambah", $data);
    }

    public function acttambah_nelayan(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
            $kodeitem = Csql::generateKode2("kodeitem", date("Ymd")."-ITEM", $this->baseTable);

            $gambaritem = Cupload::UploadGambar('gambaritem', '', $request);

			DB::table($this->baseTable)->insert([[
                'kodeitem' => Cfilter::FilterString($kodeitem),
                'kodenelayan' => Cfilter::FilterString(session('kodenelayan')),
                'kodejenisitem' => Cfilter::FilterString($request->input('kodejenisitem')),
                'namaitem' => Cfilter::FilterString($request->input('namaitem')),
                'hargaitem' => Cfilter::FilterInt($request->input('hargaitem')),
                'satuan' => Cfilter::FilterString($request->input('satuan')),
                'stokitem' => Cfilter::FilterInt(0),
                'gambaritem' => Cfilter::FilterString($gambaritem),
                'keteranganitem' => Cfilter::FilterString($request->input('keteranganitem')),
                'dateadditem' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupditem' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'tambah_nelayan'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('kodeitem')."</b>");
		return redirect()->action([aAlatGym::class, 'list_nelayan'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit_nelayan(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodeitem'));
			$gambaritem_old = Csql::cariData2('gambaritem', 'kodeitem', $id, $this->baseTable);
			$gambaritem = Cupload::UploadGambar('gambaritem', $gambaritem_old, $request);

			// update user
			DB::table($this->baseTable)
	            ->where('kodeitem', "=", $id)
	            ->update
	            ([
		            'kodejenisitem' => Cfilter::FilterString($request->input('kodejenisitem')),
	                'namaitem' => Cfilter::FilterString($request->input('namaitem')),
	                'satuan' => Cfilter::FilterString($request->input('satuan')),
	                'hargaitem' => Cfilter::FilterInt($request->input('hargaitem')),
	                'namaitem' => Cfilter::FilterString($request->input('namaitem')),
	                'keteranganitem' => Cfilter::FilterString($request->input('keteranganitem')),
	                'gambaritem' => Cfilter::FilterString($gambaritem),
	                'dateadditem' => Cfilter::FilterString(date("Y-m-d H:i")),
                	'dateupditem' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'edit_nelayan'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodeitem')."</b>");
		return redirect()->action([aAlatGym::class, 'edit_nelayan'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus_nelayan($id)
    {
		DB::beginTransaction();

        try
        {
            DB::table($this->baseTable)
                ->where('kodeitem', '=', $id)
                ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAlatGym::class, 'list_nelayan'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aAlatGym::class, 'list_nelayan'])->with('pesaninfo', $this->pesaninfo);
    }
}
?>
