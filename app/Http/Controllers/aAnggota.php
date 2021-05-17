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

use App\Http\Controllers\aAnggota;

class aAnggota extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_anggota";
    	$this->prefix = "anggota";
    	$this->pagename = "Anggota";
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
                        ->where('statusanggota', '=', 1)
						->orderBy('kodeanggota', 'desc')
						->get();

        return view("admin/$this->prefix/list", $data);
    }

    public function verifikasi(Request $request)
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
                        ->whereIn('statusanggota', [0,2])
						->orderBy('kodeanggota', 'desc')
						->get();

        return view("admin/$this->prefix/verifikasi", $data);
    }

    public function informasi(Request $request)
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
                        ->where('statusanggota', '=', 1)
						->orderBy('kodeanggota', 'desc')
						->get();

        return view("admin/$this->prefix/informasi", $data);
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
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/$this->prefix/list")."'>$this->pagename</a></li>";
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
                        ->where('kodeanggota', '=', $id)
                        ->first();

        $data['password'] = Crypt::decryptString($data['rows']->password);

        return view("admin/$this->prefix/tambah", $data);
    }

    public function detail($id)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Edit</li>";
		$breadcrumb []= "<li class='breadcrumb-item'><b>$id</b></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
                        ->where('kodeanggota', '=', $id)
                        ->first();

        $data['password'] = Crypt::decryptString($data['rows']->password);

        return view("admin/$this->prefix/detail", $data);
    }

    public function verifikasidetail($id)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Edit</li>";
		$breadcrumb []= "<li class='breadcrumb-item'><b>$id</b></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
                        ->where('kodeanggota', '=', $id)
                        ->first();

        $data['password'] = Crypt::decryptString($data['rows']->password);

        return view("admin/$this->prefix/verifikasidetail", $data);
    }

    public function acttambah(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
			$useranggota = Cfilter::FilterString($request->input('useranggota'));

			$cekdata = Csql::cariData2("useranggota", "useranggota", $useranggota, $this->baseTable);
			if($cekdata != "")
			{
				$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>useranggota</b> sudah ada.");
				return redirect()->action([aAnggota::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
			}

            $kodeanggota = Csql::generateKode2("kodeanggota", date("Ymd")."-ANGGOTA", $this->baseTable);

            $gambaranggota = Cupload::UploadGambar('gambaranggota', '', $request);

			DB::table($this->baseTable)->insert([[
                'kodeanggota' => Cfilter::FilterString($kodeanggota),
                'useranggota' => Cfilter::FilterString($request->input('useranggota')),
                'password' => Crypt::encryptString($request->input('password')),
                'namaanggota' => Cfilter::FilterString($request->input('namaanggota')),
                'noteleponanggota' => Cfilter::FilterString($request->input('noteleponanggota')),
                'alamatanggota' => Cfilter::FilterString($request->input('alamatanggota')),
                'jk' => Cfilter::FilterString($request->input('jk')),
                'gambaranggota' => $gambaranggota,
                'statusanggota' => 1,
                'dateaddanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAnggota::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('kodeanggota')."</b>");
		return redirect()->action([aAnggota::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$useranggota = Cfilter::FilterString($request->input('useranggota'));
			$useranggota_old = Cfilter::FilterString($request->input('useranggota_old'));

			if($useranggota != $useranggota_old)
			{
				// cek apakah ada useradmin yang sama
				$cekdata = Csql::cariData2("useranggota", "useranggota", $useranggota, $this->baseTable);
				if($cekdata != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>useranggota</b> sudah ada.");
					return redirect()->action([aAnggota::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			$id = Cfilter::FilterString($request->input('kodeanggota'));
			$gambaranggota_old = Csql::cariData2('gambaranggota', 'kodeanggota', $id, $this->baseTable);
			$gambaranggota = Cupload::UploadGambar('gambaranggota', $gambaranggota_old, $request);

			// update user
			DB::table($this->baseTable)
	            ->where('kodeanggota', "=", $id)
	            ->update
	            ([
		            'useranggota' => Cfilter::FilterString($request->input('useranggota')),
	                'password' => Crypt::encryptString($request->input('password')),
	                'namaanggota' => Cfilter::FilterString($request->input('namaanggota')),
	                'noteleponanggota' => Cfilter::FilterString($request->input('noteleponanggota')),
	                'alamatanggota' => Cfilter::FilterString($request->input('alamatanggota')),
	                'jk' => Cfilter::FilterString($request->input('jk')),
	                'gambaranggota' => $gambaranggota,
                	'dateupdanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAnggota::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodeanggota')."</b>");
		return redirect()->action([aAnggota::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function actverifikasi(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$kodeanggota = Cfilter::FilterString($request->input('kodeanggota'));

			// update user
			DB::table($this->baseTable)
	            ->where('kodeanggota', "=", $kodeanggota)
	            ->update
	            ([
		            'statusanggota' => Cfilter::FilterString($request->input('statusanggota')),
		            'alasanditolak' => Cfilter::FilterString($request->input('alasanditolak')),
                	'dateupdanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAnggota::class, 'verifikasidetail'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodeanggota')."</b>");
		return redirect()->action([aAnggota::class, 'verifikasidetail'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
        	DB::table($this->baseTable)
	            ->where('kodeanggota', "=", $id)
	            ->update
	            ([
		            'statusanggota' => Cfilter::FilterInt(2),
	            ]);

            // DB::table($this->baseTable)
            //     ->where('kodeanggota', '=', $id)
            //     ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAnggota::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aAnggota::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

    
}
?>
