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

use App\Http\Controllers\aKonfirmasi;

class aKonfirmasi extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_konfirmasi";
    	$this->prefix = "konfirmasi";
    	$this->pagename = "Konfirmasi";
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
                        ->join('tbl_anggota', 'tbl_anggota.kodeanggota', '=', 'tbl_konfirmasi.kodeanggota')
						->orderBy('tbl_konfirmasi.kodekonfirmasi', 'desc')
						->get();

        return view("admin/$this->prefix/list", $data);
    }

    public function detail($id)
    {
		// breadcrumb
		$breadcrumb = array();
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/dashboard")."'> Dashboard</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'><a href='".url("admin/$this->prefix/list")."'>$this->pagename</a></li>";
		$breadcrumb []= "<li class='breadcrumb-item'>Detail</li>";
		$breadcrumb []= "<li class='breadcrumb-item'><b>$id</b></li>";
		$data['breadcrumb'] = join($breadcrumb, "");

		// Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;
		$data['aksi'] = 'actedit';

		// paramerter error
		$data['pesaninfo'] = "";
		$data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
        				->join('tbl_anggota', 'tbl_anggota.kodeanggota', '=', 'tbl_konfirmasi.kodeanggota')
                        ->where('tbl_konfirmasi.kodekonfirmasi', '=', $id)
                        ->first();

        return view("admin/$this->prefix/detail", $data);
    }


    public function actedit(Request $request)
    {
        // Update Data

		DB::beginTransaction();

		try {

			$id = Cfilter::FilterString($request->input('kodekonfirmasi'));
			$statuskonfirmasi = Cfilter::FilterString($request->input('statuskonfirmasi'));

			// update user
			DB::table($this->baseTable)
	            ->where('kodekonfirmasi', "=", $id)
	            ->update
	            ([
		            'statuskonfirmasi' => $statuskonfirmasi,
		            'alasangagal' => Cfilter::FilterString($request->input('alasangagal')),
                	'dateupdkonfirmasi' => Cfilter::FilterString(date("Y-m-d H:i")),
	            ]);

	        // jika valid
			if($statuskonfirmasi == 1)
			{
				$kodeanggota = Csql::cariData2("kodeanggota", "kodekonfirmasi", $id, "tbl_konfirmasi");
				$tanggalaktifsampai = Csql::cariData2("tanggalaktifsampai", "kodeanggota", $kodeanggota, "tbl_anggota");

				// jika sudah kadaluwarsa, tambah harinya berdasarkan tanggal sekarang
				if($tanggalaktifsampai == "" || $tanggalaktifsampai < date('Y-m-d'))
				{
					$datevalid = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
				}

				// jika anggota memperpanjang sebelum kadaluwarsa
				else
				{
					$datevalid = date('Y-m-d', strtotime($tanggalaktifsampai. ' + 30 days'));
				}

				DB::table("tbl_anggota")
	            ->where('kodeanggota', "=", $kodeanggota)
	            ->update
	            ([
		            'tanggalaktifsampai' => $datevalid,
	            ]);
			}


		    DB::commit();
		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Update Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aKonfirmasi::class, 'detail'], ['id' => $id])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Update Data : <b>".$request->input('kodekonfirmasi')."</b>");
		return redirect()->action([aKonfirmasi::class, 'detail'], ['id' => $id])->with('pesaninfo', $this->pesaninfo);

    }

    public function acthapus($id)
    {
		DB::beginTransaction();

        try
        {
        	// DB::table($this->baseTable)
	        //     ->where('kodealatgym', "=", $id)
	        //     ->update
	        //     ([
		       //      'statusalatgym' => Cfilter::FilterInt(2),
	        //     ]);

            DB::table($this->baseTable)
                ->where('kodekonfirmasi', '=', $id)
                ->delete();

		    DB::commit();

		} catch (\Exception $ex) {
		    DB::rollback();
			$this->pesaninfo = Cview::pesanGagal("Kesalahan Hapus Data : <b>".$ex->getMessage()."</b>");
			return redirect()->action([aKonfirmasi::class, 'list'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
		}

		// jika berhasil
		$this->pesaninfo = Cview::pesanSukses("Berhasil Hapus Data : <b>".$id."</b>");
		return redirect()->action([aKonfirmasi::class, 'list'])->with('pesaninfo', $this->pesaninfo);
    }

    
}
?>
