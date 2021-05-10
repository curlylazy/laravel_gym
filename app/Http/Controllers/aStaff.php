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

use App\Http\Controllers\aStaff;

class aStaff extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_admin";
    	$this->prefix = "staff";
    	$this->pagename = "Staff";

    	// cek apakah sudah login atau belum
    	$this->middleware('ceklogin');
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
                        ->where('statusadmin', '=', 1)
						->orderBy('tbl_admin.kodeadmin', 'desc')
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
                        ->where('kodeadmin', '=', $id)
                        ->where('statusadmin', '=', 1)
                        ->first();

        $data['password'] = Crypt::decryptString($data['rows']->password);

        return view("admin/$this->prefix/tambah", $data);
    }

    public function acttambah(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{

			$useradmin = Cfilter::FilterString($request->input('useradmin'));

			// cek apakah ada useradmin yang sama
			$cekuseradmin = Csql::cariData2("useradmin", "useradmin", $useradmin, $this->baseTable);
			if($cekuseradmin != "")
			{
				$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>useradmin</b> sudah ada.");
				return redirect()->action([aStaff::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
			}

            $kodeadmin = Csql::generateKode2("kodeadmin", "ADMIN", $this->baseTable);

			// simpan ke table user_login
			DB::table($this->baseTable)->insert([[
                'kodeadmin' => Cfilter::FilterString($kodeadmin),
                'useradmin' => Cfilter::FilterString($request->input('useradmin')),
                'namaadmin' => Cfilter::FilterString($request->input('namaadmin')),
                'akses' => Cfilter::FilterString("STAFF"),
                'password' => Crypt::encryptString($request->input('password')),
                'statusadmin' => Cfilter::FilterInt(1),
                'dateaddadmin' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdadmin' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aStaff::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('namauser')."</b>");
		return redirect()->action([aStaff::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

            $id = Cfilter::FilterString($request->input('kodeadmin'));
            $useradmin = Cfilter::FilterString($request->input('useradmin'));
			$useradmin_old = Cfilter::FilterString($request->input('useradmin_old'));

			if($useradmin != $useradmin_old)
			{
				// cek apakah ada useradmin yang sama
				$cekuseradmin = Csql::cariData2("useradmin", "useradmin", $useradmin, $this->baseTable);
				if($cekuseradmin != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>useradmin</b> sudah ada.");
					return redirect()->action([aStaff::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			// update user
			DB::table($this->baseTable)
	            ->where('kodeadmin', "=", $id)
	            ->update
	            ([
		            'useradmin' => Cfilter::FilterString($request->input('useradmin')),
                    'namaadmin' => Cfilter::FilterString($request->input('namaadmin')),
                    'password' => Crypt::encryptString($request->input('password')),
                    'dateupdadmin' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aStaff::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('namaadmin')."</b>");
		return redirect()->action([aStaff::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
        	DB::table($this->baseTable)
	            ->where('kodeadmin', "=", $id)
	            ->update
	            ([
		            'statusadmin' => Cfilter::FilterInt(2),
	            ]);

            // DB::table($this->baseTable)
            //     ->where('kodeadmin', '=', $id)
            //     ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aStaff::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aStaff::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

}
?>
