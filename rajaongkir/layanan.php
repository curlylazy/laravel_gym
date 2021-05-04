<?php 

// 501 kab

$query_data = array(
	'origin'=> '114',
	'originType'=> 'city',
	'destination'=> '151',
	'destinationType'=> 'city',
	'weight'=> 1700,
	'courier'=> 'jne'
);

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 3000,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => http_build_query($query_data),
	// CURLOPT_POSTFIELDS => "origin=501&originType=city&destination=574&destinationType=subdistrict&weight=1700&courier=jne",
	CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
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
	$layanan = array();
	foreach($data['rajaongkir']['results'][0]['costs'] as $rows => $row) 
	{
		

		// $city_value = $x_value['city_id'];
		// $city_name = $x_value['city_name'];
		// echo "$row[service] $row[description]<br />";
	}

	// $layanan = json_encode($layanan);
	$data_me = $data['rajaongkir']['results'][0]['costs'];
	$key = array_search('OKE', array_column($data_me, 'service'));
	echo $biaya = $data_me[$key]['cost'][0]['value'];
}

$userdb = array(
    array(
        'uid' => '100',
        'name' => 'Sandra Shush',
        'pic_square' => 'urlof100'
    ),
    array(
        'uid' => '5465',
        'name' => 'Stefanie Mcmohn',
        'pic_square' => 'urlof100'
    ),
    array(
        'uid' => '40489',
        'name' => 'Michael',
        'pic_square' => 'urlof40489'
    )
);

// echo "<hr />";
// print_r($userdb);

$key = array_search('5465', array_column($userdb, 'uid'));


// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "origin=501&originType=city&destination=574&destinationType=subdistrict&weight=1700&courier=jne",
//   CURLOPT_HTTPHEADER => array(
//     "content-type: application/x-www-form-urlencoded",
//     "key: e9198750715b19bfa805a4f37bb4c8c5"
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }

?>