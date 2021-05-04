<?php 

// 501 kab

// $curl = curl_init();
// curl_setopt_array($curl, array(
// 	CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
// 	CURLOPT_RETURNTRANSFER => true,
// 	CURLOPT_ENCODING => "",
// 	CURLOPT_MAXREDIRS => 10,
// 	CURLOPT_TIMEOUT => 3000,
// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 	CURLOPT_CUSTOMREQUEST => "GET",
// 	CURLOPT_HTTPHEADER => array(
// 	"key: e9198750715b19bfa805a4f37bb4c8c5"
// 	),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) 
// {
// 	echo "cURL Error #:" . $err;
// } 
// else 
// {
// 	$data = json_decode($response, true);
// 	$carikota = array();
// 	foreach($data['rajaongkir']['results'] as $x => $x_value) 
// 	{
		

// 		// $city_value = $x_value['city_id'];
// 		// $city_name = $x_value['city_name'];
// 		// echo "$x_value[city_id] $x_value[city_name]<br />";
// 	}

// 	$carikota = json_encode($carikota);
// 	// print_r($carikota);
// }

$start = 10;

if($start == 1)
{
	$from = 1;
	$to = 50;
}
else
{
	$from = ($start * 50 - 49);
	$to = ($start * 50);
}

echo "<h1>$to</h1>";

for($i=$from;$i<=$to;$i++)
{

}

$i = 501;

$kecamatan = file_get_contents("kecamatan.js");

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$i",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 300,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"key: e9198750715b19bfa805a4f37bb4c8c5"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) 
{
  	echo "cURL Error #:" . $err;
} 
else 
{
	$data = json_decode($response, true);
	$myJSON = array();
	$myObj = NULL;

	foreach($data['rajaongkir']['results'] as $rows => $row)
	{	
		// $array_temp = array(
		// 	"value" => $row['subdistrict_id'],
		// 	"label" => $row['subdistrict_name'],
		// );
		$myObj = new \stdClass();
		$myObj->idkab = $i;
		$myObj->value = $row['subdistrict_id'];
		$myObj->label = $row['subdistrict_name'];

		$myJSON[] = json_encode($myObj);

		// echo "$row[subdistrict_id] $row[subdistrict_name]<br />";

	}
}

// echo json_encode($kecamatan, true);

$myJSON[] = $kecamatan;

// file_put_contents("kecamatan.js", join($myJSON, ","));

$kecamatan_hasil = file_get_contents("kecamatan.js");

echo "$kecamatan_hasil <hr />";

?>