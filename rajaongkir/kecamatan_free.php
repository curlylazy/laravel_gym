<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=1",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 300,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"key: 960072952532bfedab571e104404e584"
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
	echo $response;
}

// echo json_encode($kecamatan, true);


?>