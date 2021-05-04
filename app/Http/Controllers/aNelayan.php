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

use App\Http\Controllers\aNelayan;

class aNelayan extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_nelayan";
    	$this->prefix = "nelayan";
    	$this->pagename = "Nelayan";

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
						->orderBy('tbl_nelayan.kodenelayan', 'desc')
						->get();

        return view("admin/$this->prefix/list", $data);
    }

	public function tambah()
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
                        ->where('kodenelayan', '=', $id)
                        ->first();

        $data['passwordnelayan'] = Crypt::decryptString($data['rows']->passwordnelayan);

        return view("admin/$this->prefix/tambah", $data);
    }

    public function acttambah(Request $request)
    {

		// pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
			$usernelayan = Cfilter::FilterString($request->input('usernelayan'));

			// cek apakah ada usernelayan yang sama
			$cekusernelayan = Csql::cariData2("usernelayan", "usernelayan", $usernelayan, $this->baseTable);
			if($cekusernelayan != "")
			{
				$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>usernelayan</b> sudah ada.");
				return redirect()->action([aNelayan::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
			}

            $kodenelayan = Csql::generateKode2("kodenelayan", "NELAYAN", $this->baseTable);

            $gambarnelayan = Cupload::UploadGambar('gambarnelayan', '', $request);

			// simpan ke table user_login
			DB::table($this->baseTable)->insert([[
                'kodenelayan' => Cfilter::FilterString($kodenelayan),
                'usernelayan' => Cfilter::FilterString($request->input('usernelayan')),
                'passwordnelayan' => Crypt::encryptString($request->input('passwordnelayan')),
                'namanelayan' => Cfilter::FilterString($request->input('namanelayan')),
                'emailnelayan' => Cfilter::FilterString($request->input('emailnelayan')),
                'noteleponnelayan' => Cfilter::FilterString($request->input('noteleponnelayan')),
                'rek_noreknelayan' => Cfilter::FilterString($request->input('rek_noreknelayan')),
                'rek_annelayan' => Cfilter::FilterString($request->input('rek_annelayan')),
                'rek_banknelayan' => Cfilter::FilterString($request->input('rek_banknelayan')),
                'keterangannelayan' => Cfilter::FilterString($request->input('keterangannelayan')),
                'gambarnelayan' => Cfilter::FilterString($gambarnelayan),
                'dateaddnelayan' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdnelayan' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aNelayan::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('usernelayan')."</b>");
		return redirect()->action([aNelayan::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodenelayan'));
			$usernelayan = Cfilter::FilterString($request->input('usernelayan'));
			$usernelayan_old = Cfilter::FilterString($request->input('usernelayan_old'));

			if($usernelayan != $usernelayan_old)
			{
				// cek apakah ada usernelayan yang sama
				$cekusernelayan = Csql::cariData2("usernelayan", "usernelayan", $usernelayan, $this->baseTable);
				if($cekusernelayan != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>usernelayan</b> sudah ada.");
					return redirect()->action([aNelayan::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			$gambarnelayan_old = Csql::cariData2('gambarnelayan', 'kodenelayan', $id, $this->baseTable);
			$gambarnelayan = Cupload::UploadGambar('gambarnelayan', $gambarnelayan_old, $request);

			// update user
			DB::table($this->baseTable)
	            ->where('kodenelayan', "=", $id)
	            ->update
	            ([
		            'usernelayan' => Cfilter::FilterString($request->input('usernelayan')),
	                'passwordnelayan' => Crypt::encryptString($request->input('passwordnelayan')),
	                'namanelayan' => Cfilter::FilterString($request->input('namanelayan')),
	                'emailnelayan' => Cfilter::FilterString($request->input('emailnelayan')),
	                'noteleponnelayan' => Cfilter::FilterString($request->input('noteleponnelayan')),
	                'rek_noreknelayan' => Cfilter::FilterString($request->input('rek_noreknelayan')),
	                'rek_annelayan' => Cfilter::FilterString($request->input('rek_annelayan')),
	                'rek_banknelayan' => Cfilter::FilterString($request->input('rek_banknelayan')),
	                'keterangannelayan' => Cfilter::FilterString($request->input('keterangannelayan')),
	                'gambarnelayan' => Cfilter::FilterString($gambarnelayan),
	                'dateaddnelayan' => Cfilter::FilterString(date("Y-m-d H:i")),
                	'dateupdnelayan' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aNelayan::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('usernelayan')."</b>");
		return redirect()->action([aNelayan::class, 'edit'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
            DB::table($this->baseTable)
                ->where('kodenelayan', '=', $id)
                ->delete();

			// DB::table($this->baseTable)
	        //     ->where('kodejenis', "=", $id)
	        //     ->update
	        //     ([
			// 		'statusbarang' => Cfilter::FilterInt(2),
	        //     ]);

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aNelayan::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aNelayan::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

}
?>
