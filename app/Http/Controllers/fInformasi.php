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

    public function tambah()
    {
        $this->middleware('cekloginfront');

        // Judul Halaman
        $data['prefix'] = $this->prefix;
        $data['aksi'] = "acttambah";

        // paramerter error
        $data['pesaninfo'] = "";
        $data['iserror'] = false;

        return view("front/$this->prefix/tambah", $data);
    }

    public function edit($id)
    {
        $this->middleware('cekloginfront');

        $kodeanggota = session('kodeanggota');

        $data['rows'] = DB::table($this->baseTable)
                        ->where('tbl_konfirmasi.kodeanggota', '=', $kodeanggota)
                        ->where('tbl_konfirmasi.kodekonfirmasi', '=', $id)
                        ->first();

        // Judul Halaman
        $data['prefix'] = $this->prefix;
        $data['aksi'] = "actedit";

        // paramerter error
        $data['pesaninfo'] = "";
        $data['iserror'] = false;

        return view("front/$this->prefix/tambah", $data);
    }

    public function acttambah(Request $request)
    {

        // pass request
        $data['request'] = $request;

        DB::beginTransaction();

        try
        {

            $kodekonfirmasi = Csql::generateKode2("kodekonfirmasi", date("Ymd")."-KONFIRMASI", $this->baseTable);
            $gambarbukti = Cupload::UploadGambar('gambarbukti', '', $request);

            DB::table($this->baseTable)->insert([[
                'kodekonfirmasi' => Cfilter::FilterString($kodekonfirmasi),
                'kodeanggota' => session('kodeanggota'),
                'norek' => Cfilter::FilterString($request->input('norek')),
                'bank' => Cfilter::FilterString($request->input('bank')),
                'an' => Cfilter::FilterString($request->input('an')),
                'tanggalkonfirmasi' => Cfilter::FilterString($request->input('tanggalkonfirmasi')),
                'statuskonfirmasi' => Cfilter::FilterInt(0),
                'gambarbukti' => $gambarbukti,
                'dateaddkonfirmasi' => Cfilter::FilterString(date("Y-m-d H:i")),
                'dateupdkonfirmasi' => Cfilter::FilterString(date("Y-m-d H:i")),
            ]]);

            DB::commit();

        } catch (\Exception $ex) {
            DB::rollback();
            $this->pesaninfo = Cview::pesanGagal("Kesalahan Tambah Data : <b>".$ex->getMessage()."</b>");
            return redirect()->action([fInformasi::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
        }

        // jika berhasil
        $this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('namauser')."</b>");
        return redirect()->action([fInformasi::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

    public function actedit(Request $request)
    {

        // pass request
        $data['request'] = $request;

        DB::beginTransaction();

        try
        {

            $kodekonfirmasi = Cfilter::FilterString($request->input('kodekonfirmasi'));
            
            $gambarbukti_old = Csql::cariData2('gambarbukti', 'kodekonfirmasi', $kodekonfirmasi, $this->baseTable);
            $gambarbukti = Cupload::UploadGambar('gambarbukti', $gambarbukti_old, $request);

            // update status transaksi
            DB::table($this->baseTable)
                ->where('kodekonfirmasi', "=", $kodekonfirmasi)
                ->update
                ([
                    'norek' => Cfilter::FilterString($request->input('norek')),
                    'bank' => Cfilter::FilterString($request->input('bank')),
                    'an' => Cfilter::FilterString($request->input('an')),
                    'tanggalkonfirmasi' => Cfilter::FilterString($request->input('tanggalkonfirmasi')),
                    'statuskonfirmasi' => Cfilter::FilterInt(0),
                    'gambarbukti' => $gambarbukti,
                ]);

            DB::commit();

        } catch (\Exception $ex) {
            DB::rollback();
            $this->pesaninfo = Cview::pesanGagal("Kesalahan konfirmasi transaksi : <b>".$ex->getMessage()."</b>");
            return redirect()->action([fInformasi::class, 'tambah'], ['id' => $kodekonfirmasi])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
        }

        // jika berhasil
        $this->pesaninfo = Cview::pesanSukses("Konfirmasi berhasil untuk transaksi dengan kode : <b>".$kodekonfirmasi."</b>, pihak toko akan segera melakukan proses pengecekan.");
        return redirect()->action([fInformasi::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

}
?>
