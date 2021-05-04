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
use App\Lib\Carray;
use App\Lib\Cfilter;
use App\Lib\Cconfig;

class fAjax extends Controller
{
	public function __construct()
    {

    }

    public function getongkir(Request $request)
    {
        try
		{
			$pengiriman_kabupaten = Cfilter::FilterString($request->input('pengiriman_kabupaten'));
			$pengiriman_kabupaten_id = Csql::GetKabupatenID($pengiriman_kabupaten);
				
			$rows = array();

			$objtemp = new \stdClass();
			$objtemp->pengiriman_kabupaten = $pengiriman_kabupaten;
			$objtemp->pengiriman_kabupaten_id = $pengiriman_kabupaten_id;
			$rows[] = $objtemp;

			$dtjson = json_encode($rows);

			return $dtjson;

		} catch (Exception $ex) {

			return $ex->getMessage();

		} catch(\Illuminate\Database\QueryException $ex){

            DB::rollback();
            return $ex->getMessage();
        }
    }
}
?>
