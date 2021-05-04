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
use App\Http\Controllers\fTransaksi;

class fTransaksi extends Controller
{
	public function __construct()
    {
		// page data
		$this->pesan = "";
    	$this->baseTable = "tbl_transaksi_hd";
    	$this->prefix = "transaksi";
    	$this->pagename = "Transaksi";
    }

    public function list(Request $request)
    {
		$kodepelanggan = session('kodepelanggan');

        // Judul Halaman
		$data['prefix'] = $this->prefix;
		$data['pagename'] = $this->pagename;

        $rows_transaksi = DB::table($this->baseTable)
                        ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_transaksi_hd.kodenelayan')
                        ->where('tbl_transaksi_hd.kodepelanggan', '=', $kodepelanggan)
                        ->orderBy('tbl_transaksi_hd.kodetransaksi', 'desc')
                        ->simplePaginate(8);

        $arr_transaksi = [];
        foreach($rows_transaksi as $row)
        {
            $objtemp = new \stdClass();
            $kodetransaksi = $row->kodetransaksi;
            $kodenelayan = $row->kodenelayan;

            $objtemp->kodetransaksi = $kodetransaksi;
            $objtemp->kodenelayan = $kodenelayan;
            $objtemp->namanelayan = $row->namanelayan;
            $objtemp->totaltransaksi = $row->totaltransaksi;
            $objtemp->konfirmasi_status = $row->konfirmasi_status;
            $objtemp->tanggaltransaksi = $row->dateaddtransaksi;
            $objtemp->transaksiitem = Csql::getItemInTransaksiByToko($kodetransaksi);
            $objtemp->konfirmasi_status_str = Csql::cekStatusKonfirmasi($row->konfirmasi_status);
            
            if($row->pengiriman_mode == 'DIKIRIM')
                $objtemp->pengiriman_mode = "Dikirim Oleh Nelayan";
            else
                $objtemp->pengiriman_mode = "Diambil Ke Tempat";
        
            $arr_transaksi[] = $objtemp;
        }

        $data['paging_transaksi'] = $rows_transaksi;
        $data['rows_transaksi'] = $arr_transaksi;

        return view("front/$this->prefix/list", $data);
    }

    public function konfirmasi($id)
    {
        $this->middleware('cekloginfront');

        $kodepelanggan = session('kodepelanggan');

        // Judul Halaman
        $data['prefix'] = $this->prefix;

        // paramerter error
        $data['pesaninfo'] = "";
        $data['iserror'] = false;

        $data['rows'] = DB::table($this->baseTable)
                        ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_transaksi_hd.kodenelayan')
                        ->where('tbl_transaksi_hd.kodepelanggan', '=', $kodepelanggan)
                        ->where('tbl_transaksi_hd.kodetransaksi', '=', $id)
                        ->first();

        return view("front/$this->prefix/konfirmasi", $data);
    }

    public function detail($id)
    {
        $this->middleware('cekloginfront');

        $kodepelanggan = session('kodepelanggan');

        // Judul Halaman
        $data['prefix'] = $this->prefix;

        // paramerter error
        $data['pesaninfo'] = "";
        $data['iserror'] = false;

        $data['row_transaksi'] = DB::table($this->baseTable)
                    ->join('tbl_nelayan', 'tbl_nelayan.kodenelayan', '=', 'tbl_transaksi_hd.kodenelayan')
                    ->join('tbl_pelanggan', 'tbl_pelanggan.kodepelanggan', '=', 'tbl_transaksi_hd.kodepelanggan')
                    ->where('tbl_transaksi_hd.kodepelanggan', '=', $kodepelanggan)
                    ->where('tbl_transaksi_hd.kodetransaksi', '=', $id)
                    ->first();

        $data['rows_transaksi_dt'] = DB::table('tbl_transaksi_dt')
                    ->join('tbl_item', 'tbl_item.kodeitem', '=', 'tbl_transaksi_dt.kodeitem')
                    ->join('tbl_jenis_item', 'tbl_jenis_item.kodejenisitem', '=', 'tbl_item.kodejenisitem')
                    ->where('tbl_transaksi_dt.kodetransaksi', '=', $id)
                    ->get();

        if($data['row_transaksi']->pengiriman_mode == 'DIKIRIM')
        {
            $pengiriman_mode = "Dikirim Oleh Nelayan";
        }
        else
        {
            $pengiriman_mode = "Diambil Ke Tempat";
        }

        $data['pengiriman_mode'] = $pengiriman_mode;

        return view("front/$this->prefix/detail", $data);
    }

    public function actkonfirmasi(Request $request)
    {

        // pass request
        $data['request'] = $request;

        DB::beginTransaction();

        try
        {

            $kodetransaksi = Cfilter::FilterString($request->input('kodetransaksi'));
            $konfirmasi_bukti = Cupload::UploadGambar('konfirmasi_bukti', '', $request);

            // update status transaksi
            DB::table($this->baseTable)
                ->where('kodetransaksi', "=", $kodetransaksi)
                ->update
                ([
                    'konfirmasi_status' => Cfilter::FilterInt(1),
                    'konfirmasi_bukti' => $konfirmasi_bukti,
                    'konfirmasi_bank' => Cfilter::FilterString($request->input('konfirmasi_bank')),
                    'konfirmasi_norek' => Cfilter::FilterString($request->input('konfirmasi_norek')),
                    'konfirmasi_tanggal' => Cfilter::FilterString($request->input('konfirmasi_tanggal')),
                    'konfirmasi_an' => Cfilter::FilterString($request->input('konfirmasi_an')),
                ]);

            DB::commit();

        } catch (\Exception $ex) {
            DB::rollback();
            $this->pesaninfo = Cview::pesanGagal("Kesalahan konfirmasi transaksi : <b>".$ex->getMessage()."</b>");
            return redirect()->action([fTransaksi::class, 'konfirmasi'], ['id' => $kodetransaksi])->with('pesaninfo', $this->pesaninfo)->with('erroract', true)->withInput();
        }

        // jika berhasil
        $this->pesaninfo = Cview::pesanSukses("Konfirmasi berhasil untuk transaksi dengan kode : <b>".$kodetransaksi."</b>, pihak toko akan segera melakukan proses pengecekan.");
        return redirect()->action([fTransaksi::class, 'detail'], ['id' => $kodetransaksi])->with('pesaninfo', $this->pesaninfo);

    }

}
?>
