<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

// load library
use App\Lib\Csql;
use App\Lib\Cupload;
use App\Lib\Cfilter;
use App\Lib\Cview;

use App\Http\Controllers\fAuth;
use App\Http\Controllers\fInfo;

class fAuth extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_anggota";
    	$this->prefix = "auth";
    	$this->pagename = "Auth";

    	// cek apakah sudah login atau belum
    	// $this->middleware('ceklogin');
    }

    public function login(Request $request)
    {
        return view("front/$this->prefix/login");
    }

    public function registrasi(Request $request)
    {
        return view("front/$this->prefix/registrasi");
    }

    public function revisi($id)
    {
		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = 'Profile Pelanggan';
		$data['aksi'] = "actupdateprofile";

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table('tbl_anggota')
                        ->where('kodeanggota', '=', $id)
                        ->first();

        $data['password_dec'] = Crypt::decryptString($data['rows']->password);

        return view("front/$this->prefix/revisi", $data);
    }

    public function profile()
    {
    	// $this->middleware('ceklogin');

    	$id = session('kodeanggota');

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = 'Profile Pelanggan';
		$data['aksi'] = "actupdateprofile";

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
                        ->where('kodeanggota', '=', $id)
                        ->first();

        $data['password_dec'] = Crypt::decryptString($data['rows']->password);

        return view("front/$this->prefix/profile", $data);
    }

    public function actregistrasi(Request $request)
    {
        // pass request
		$data['request'] = $request;

		DB::beginTransaction();

		try
		{
            $useranggota = Cfilter::FilterString($request->input('useranggota'));

            // cek apakah ada username yang sama
			$cekusername = Csql::cariData2("useranggota", "useranggota", $useranggota, $this->baseTable);
			if($cekusername != "")
			{
				$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>username : $useranggota</b> sudah ada.");
				return redirect()->action([fAuth::class, 'registrasi'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
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
                'statusanggota' => Cfilter::FilterInt(0),
                'gambaranggota' => Cfilter::FilterString($gambaranggota),
                'dateaddanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdanggota' => Cfilter::FilterString(date("Y-m-d H:i")),
			]]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([fAuth::class, 'registrasi'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('namaanggota')."</b>, silahkan menunggu proses verifikasi dari pihak staff kami.");
		return redirect()->action([fAuth::class, 'registrasi'])->with('pesaninfo', $this->pesaninfo);
    }

    public function actupdateprofile(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

            $kodeanggota = session('kodeanggota');
            $useranggota = Cfilter::FilterString($request->input('useranggota'));
			$useranggota_old = Cfilter::FilterString($request->input('useranggota_old'));

			$gambaranggota_old = Csql::cariData2('gambaranggota', 'kodeanggota', $kodeanggota, $this->baseTable);
			$gambaranggota = Cupload::UploadGambar('gambaranggota', $gambaranggota_old, $request);

			if($useranggota_old != $useranggota)
			{
				// cek apakah ada username yang sama
				$cekusername = Csql::cariData2("useranggota_old", "useranggota", $useranggota_old, $this->baseTable);
				if($cekusername != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>username</b> sudah ada.");
					return redirect()->action([fAuth::class, 'revisi'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			// update user
			DB::table($this->baseTable)
	            ->where('kodeanggota', "=", $kodeanggota)
	            ->update
	            ([
		            'useranggota' => Cfilter::FilterString($request->input('useranggota')),
	                'password' => Crypt::encryptString($request->input('password')),
	                'namaanggota' => Cfilter::FilterString($request->input('namaanggota')),
	                'noteleponanggota' => Cfilter::FilterString($request->input('noteleponanggota')),
	                'alamatanggota' => Cfilter::FilterString($request->input('alamatanggota')),
	                'jk' => Cfilter::FilterString($request->input('jk')),
	                'statusanggota' => Cfilter::FilterInt(0),
	                'gambaranggota' => Cfilter::FilterString($gambaranggota),
	            ]);

            DB::commit();

	        session([
				'useranggota' => Cfilter::FilterString($request->input('useranggota')),
				'namaanggota' => Cfilter::FilterString($request->input('namaanggota'))
			]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Profile Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([fAuth::class, 'profile'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Profile Data : <b>".$request->input('namaanggota')."</b>");
		return redirect()->action([fAuth::class, 'profile'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actrevisi(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

            $kodeanggota = Cfilter::FilterString($request->input('kodeanggota'));
            $useranggota = Cfilter::FilterString($request->input('useranggota'));
			$useranggota_old = Cfilter::FilterString($request->input('useranggota_old'));

			$gambaranggota_old = Csql::cariData2('gambaranggota', 'kodeanggota', $kodeanggota, $this->baseTable);
			$gambaranggota = Cupload::UploadGambar('gambaranggota', $gambaranggota_old, $request);

			if($useranggota_old != $useranggota)
			{
				// cek apakah ada username yang sama
				$cekusername = Csql::cariData2("useranggota_old", "useranggota", $useranggota_old, $this->baseTable);
				if($cekusername != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>username</b> sudah ada.");
					return redirect()->action([fAuth::class, 'revisi'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			// update user
			DB::table($this->baseTable)
	            ->where('kodeanggota', "=", $kodeanggota)
	            ->update
	            ([
		            'useranggota' => Cfilter::FilterString($request->input('useranggota')),
	                'password' => Crypt::encryptString($request->input('password')),
	                'namaanggota' => Cfilter::FilterString($request->input('namaanggota')),
	                'noteleponanggota' => Cfilter::FilterString($request->input('noteleponanggota')),
	                'alamatanggota' => Cfilter::FilterString($request->input('alamatanggota')),
	                'jk' => Cfilter::FilterString($request->input('jk')),
	                'statusanggota' => Cfilter::FilterInt(0),
	                'gambaranggota' => Cfilter::FilterString($gambaranggota),
	            ]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Revisi Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([fAuth::class, 'revisi'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Profile Data : <b>".$request->input('namaanggota')."</b>");
		return redirect()->action([fAuth::class, 'revisi'], ['id' => $kodeanggota])->with('pesaninfo', $this->pesaninfo);

    }

    public function actlogout(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->action([fAuth::class, 'login']);
    }

	public function actlogin(Request $request)
    {
		$useranggota = Cfilter::FilterString($request->input('useranggota'));
		$password = Cfilter::FilterString($request->input('password'));

		$sql = "SELECT * FROM tbl_anggota
				WHERE ( tbl_anggota.useranggota = '$useranggota')
				";

		$rows = DB::select(DB::raw($sql));

		if(empty($rows[0]->useranggota))
		{
			$this->pesaninfo = Cview::pesanGagal("useranggota tidak ditemukan.");
			return redirect()->action([fAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true);
		}

		else
		{
			$password_dec = Crypt::decryptString($rows[0]->password);
			if($password != $password_dec)
			{
				$this->pesaninfo = Cview::pesanGagal("useradmin atau [password] anda salah.");
				return redirect()->action([fAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo);
			}

			if($rows[0]->statusanggota == 0)
			{
				$this->pesaninfo = Cview::pesanGagal("akun anda masih dalam tahap verifikasi oleh staff kami.");
				return redirect()->action([fAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo);
			}

			if($rows[0]->statusanggota == 2)
			{
				return redirect()->action([fAuth::class, 'revisi'], ['id' => $rows[0]->kodeanggota]);
			}

			session([
				'kodeanggota' => $rows[0]->kodeanggota,
				'useranggota' => $rows[0]->useranggota,
				'namaanggota' => $rows[0]->namaanggota,
				'waktu' => date('Y-m-d H:i'),
			]);

			$this->pesaninfo = Cview::pesanSukses("Anda berhasil login, kedalam sistem.");
			return redirect()->action([fDashboard::class, 'index'])->with('pesaninfo', $this->pesaninfo);
		}
    }



}
?>
