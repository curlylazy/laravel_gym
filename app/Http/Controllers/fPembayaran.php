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

use App\Http\Controllers\fInfo;
use App\Http\Controllers\fPembayaran;

class fPembayaran extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_konfirmasi";
    	$this->prefix = "pembayaran";
    	$this->pagename = "Pembayaran";
    }

    public function list(Request $request)
    {
		$kodeanggota = session('kodeanggota');

        // Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

        $rows_transaksi = DB::table($this->baseTable)
                        ->where('tbl_konfirmasi.kodeanggota', '=', $kodeanggota)
                        ->orderBy('tbl_konfirmasi.kodekonfirmasi', 'desc')
                        ->simplePaginate(8);

        $data['paging_transaksi'] = $rows_transaksi;
        $data['rows_transaksi'] = $rows_transaksi;

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
            return redirect()->action([fPembayaran::class, 'tambah'])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
        }

        // jika berhasil
        $this->pesaninfo = Cview::pesanSukses("Berhasil Tambah Data : <b>".$request->input('namauser')."</b>");
        return redirect()->action([fPembayaran::class, 'list'])->with('pesaninfo', $this->pesaninfo);

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
            return redirect()->action([fPembayaran::class, 'tambah'], ['id' => $kodekonfirmasi])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
        }

        // jika berhasil
        $this->pesaninfo = Cview::pesanSukses("Konfirmasi berhasil untuk transaksi dengan kode : <b>".$kodekonfirmasi."</b>, pihak toko akan segera melakukan proses pengecekan.");
        return redirect()->action([fPembayaran::class, 'list'])->with('pesaninfo', $this->pesaninfo);

    }

}
?>
