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

use App\Http\Controllers\aAuth;
use App\Http\Controllers\aDashboard;

class aAuth extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_user";
    	$this->prefix = "auth";
    	$this->pagename = "Auth";

    	// cek apakah sudah login atau belum
    	// $this->middleware('ceklogin');
    }

    // ADMIN =================================================

    public function login(Request $request)
    {
        return view("admin/$this->prefix/login");
    }

    public function profile()
    {
    	$this->middleware('ceklogin');

    	$id = session('kodeadmin');

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Profile</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = 'Profile Admin';
		$data['aksi'] = "actupdateprofile";

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table('tbl_admin')
                        ->where('kodeadmin', '=', $id)
                        ->first();

        $data['password'] = Crypt::decryptString($data['rows']->password);

        return view("admin/$this->prefix/profile", $data);
    }

    public function actupdateprofile(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

            $id = session('kodeadmin');
            $useradmin = Cfilter::FilterString($request->input('useradmin'));
			$useradmin_old = Cfilter::FilterString($request->input('username_old'));

			if($useradmin != $useradmin_old)
			{
				// cek apakah ada useradmin yang sama
				$cekuseradmin = Csql::cariData2("useradmin", "useradmin", $useradmin, "tbl_user");
				if($cekuseradmin != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>useradmin</b> sudah ada.");
					return redirect()->action([aAuth::class, 'profile'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			// update user
			DB::table("tbl_admin")
	            ->where('kodeadmin', "=", $id)
	            ->update
	            ([
		            'useradmin' => Cfilter::FilterString($request->input('useradmin')),
                    'namaadmin' => Cfilter::FilterString($request->input('namaadmin')),
                    'password' => Crypt::encryptString($request->input('password')),
                    'dateupdadmin' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

	        session([
				'useradmin' => Cfilter::FilterString($request->input('useradmin')),
				'namaadmin' => Cfilter::FilterString($request->input('namaadmin'))
			]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Profile Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAuth::class, 'profile'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Profile Data : <b>".$request->input('namaadmin')."</b>");
		return redirect()->action([aAuth::class, 'profile'])->with('pesaninfo', $this->pesaninfo);
    }

    public function actlogout(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->action([aAuth::class, 'login']);
    }

	public function actlogin(Request $request)
    {
		$useradmin = Cfilter::FilterString($request->input('useradmin'));
		$password = Cfilter::FilterString($request->input('password'));

		$sql = "SELECT * FROM tbl_admin
				WHERE ( tbl_admin.useradmin = '$useradmin')
				";

		$rows = DB::select(DB::raw($sql));

		if(empty($rows[0]->useradmin))
		{
			$this->pesaninfo = "<p style='font-size: 11pt; color: #ffd7d7;'>useradmin atau password salah.</p>";
			return redirect()->action([aAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo);
		}

		else
		{
			$password_dec = Crypt::decryptString($rows[0]->password);
			if($password != $password_dec)
			{
				$this->pesaninfo = "<p style='font-size: 11pt; color: #ffd7d7;'>useradmin atau [password] anda salah.</p>";
				return redirect()->action([aAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo);
			}

			session([
				'kodeadmin' => $rows[0]->kodeadmin,
				'useradmin' => $rows[0]->useradmin,
				'namaadmin' => $rows[0]->namaadmin,
				'akses' => $rows[0]->akses,
				'waktu' => date('Y-m-d H:i'),
			]);

			return redirect()->action([aDashboard::class, 'index']);
		}
    }



    // NELAYAN ===================================

    public function login_nelayan(Request $request)
    {
    	$data['pass'] = Crypt::encryptString('12345');
        return view("nelayan/$this->prefix/login", $data);
    }

    public function actlogout_nelayan(Request $request)
    {
    	$request->session()->flush();
    	return redirect()->action([aAuth::class, 'login_nelayan']);
    }

    public function actlogin_nelayan(Request $request)
    {
		$usernelayan = Cfilter::FilterString($request->input('usernelayan'));
		$passwordnelayan = Cfilter::FilterString($request->input('passwordnelayan'));

		$sql = "SELECT * FROM tbl_nelayan
				WHERE ( tbl_nelayan.usernelayan = '$usernelayan')";

		$rows = DB::select(DB::raw($sql));

		if(empty($rows[0]->usernelayan))
		{
			$this->pesaninfo = "<p style='font-size: 11pt; color: #ffd7d7;'>useradmin atau password salah.</p>";
			return redirect()->action([aAuth::class, 'login_nelayan'])->with('pesaninfo', $this->pesaninfo);
		}

		else
		{
			$password_dec = Crypt::decryptString($rows[0]->passwordnelayan);
			if($passwordnelayan != $password_dec)
			{
				$this->pesaninfo = "<p style='font-size: 11pt; color: #ffd7d7;'>useradmin atau [password] anda salah.</p>";
				return redirect()->action([aAuth::class, 'login'])->with('pesaninfo', $this->pesaninfo);
			}

			// cek photo profile
			if($rows[0]->gambarnelayan == "")
			{
				$gambar = "noimage.jpg";
			}
			else
			{
				$gambar = $rows[0]->gambarnelayan;
			}

			session([
				'kodenelayan' => $rows[0]->kodenelayan,
				'usernelayan' => $rows[0]->usernelayan,
				'namanelayan' => $rows[0]->namanelayan,
				'gambar' => $gambar,
				'waktu' => date('Y-m-d H:i'),
			]);

			return redirect()->action([aDashboard::class, 'index_nelayan']);
		}
    }

    public function profile_nelayan()
    {
    	$this->middleware('ceklogin_nelayan');

    	$id = session('kodenelayan');

		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Profile</li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = 'Profile Nelayan';
		$data['aksi'] = "actupdateprofile";

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table('tbl_nelayan')
                        ->where('kodenelayan', '=', $id)
                        ->first();

        $data['passwordnelayan'] = Crypt::decryptString($data['rows']->passwordnelayan);

        return view("nelayan/$this->prefix/profile", $data);
    }

    public function actupdateprofile_nelayan(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

            $id = session('kodenelayan');
            $usernelayan = Cfilter::FilterString($request->input('usernelayan'));
			$usernelayan_old = Cfilter::FilterString($request->input('usernelayan_old'));

			if($usernelayan != $usernelayan_old)
			{
				// cek apakah ada useradmin yang sama
				$cekuser = Csql::cariData2("usernelayan", "usernelayan", $usernelayan, "tbl_user");
				if($cekuser != "")
				{
					$this->pesaninfo = Cview::pesanGagal("Kesalahan Edit Data : <b>usernelayan</b> sudah ada.");
					return redirect()->action([aAuth::class, 'profile_nelayan'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
				}
			}

			$gambarnelayan_old = Csql::cariData2('gambarnelayan', 'kodenelayan', $id, "tbl_nelayan");
			$gambarnelayan = Cupload::UploadGambar('gambarnelayan', $gambarnelayan_old, $request);

			// update user
			DB::table("tbl_nelayan")
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
                    'dateupdnelayan' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

	        session([
				'usernelayan' => Cfilter::FilterString($request->input('usernelayan')),
				'namanelayan' => Cfilter::FilterString($request->input('namanelayan'))
			]);

            DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Profile Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aAuth::class, 'profile_nelayan'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Profile Data : <b>".$request->input('namaadmin')."</b>");
		return redirect()->action([aAuth::class, 'profile_nelayan'])->with('pesaninfo', $this->pesaninfo);
    }

}
?>
