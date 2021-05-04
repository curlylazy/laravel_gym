<?php

// fungsi sementara menggunakan tinyurl
function get_tiny_url($url)
{  
	$ch = curl_init();  
	$timeout = 5;  
	curl_setopt($ch, CURLOPT_URL,"https://tinyurl.com/create.php");  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, "url=$url"); 
	$data = curl_exec($ch);  
	curl_close($ch);  
	return $data;  
}

echo uniqid();

//test it out!
// echo $new_url = get_tiny_url("http://www.inspirasi.biz");

?>

<!-- <form action="https://tinyurl.com/create.php" method="post" target="_blank">
<table align="center" cellpadding="5" bgcolor="#E7E7F7"><tr><td>
<b>Enter a long URL to make <a href="https://tinyurl.com">tiny</a>:</b><br />
<input type="text" name="url" size="30"><input type="submit" name="submit" value="Make TinyURL!">
</td></tr></table>
</form> -->
