<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <script
			src="https://code.jquery.com/jquery-3.3.1.min.js"
			integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			crossorigin="anonymous">
		</script>

		<script type="text/javascript">

			function get_short_url(long_url, login, api_key, func)
			{
			    $.getJSON(
			        "https://api.bitly.com/v3/shorten?callback=?", 
			        { 
			            "format": "json",
			            "apiKey": api_key,
			            "login": login,
			            "longUrl": long_url
			        },
			        function(response)
			        {
			            func(response.data.url);
			        }
			    );
			}

			$(document).ready(function(){
				

				// var login = "o_5v6ot4qoa2";
				// var api_key = "R_86869ab9e7b043a7a6c7cde104d1c165";
				// var long_url = "https://inspirasi.biz/produk/detail/KBKAT-20170403132947";

				// get_short_url(long_url, login, api_key, function(short_url) {
				//     console.log(short_url);
				// });

				var long_url = "https://inspirasi.biz/produk/detail/KBKAT-20170403132947";
				var send_url = 'https://api-ssl.bitly.com/v3/shorten?access_token=4cfd72d4d15c9ffd412cc8b19353b0c95348168b&longUrl=' + encodeURIComponent(long_url);
				$.getJSON(send_url, function(result){
    				console.log(result['data']['url']);
  				});

				// var long_url = "https://inspirasi.biz/produk/detail/KBKAT-20170403132947";
				// var url = 'https://api-ssl.bitly.com/v3/shorten?access_token=4cfd72d4d15c9ffd412cc8b19353b0c95348168b&longUrl=' + encodeURIComponent(long_url);

				// get_short_url(long_url, login, api_key, function(short_url) {
				//     console.log(short_url);
				// });

				// console.log(url);
				// let linkRequest = {
				//   destination: "https://www.youtube.com/channel/UCHK4HD0ltu1-I212icLPt3g",
				//   domain: { fullName: "rebrand.ly" }
				//   //, slashtag: "A_NEW_SLASHTAG"
				//   //, title: "Rebrandly YouTube channel"
				// }

				// let requestHeaders = {
				//   "Content-Type": "application/json",
				//   "apikey": "204a5e9259ed4d4cae54aaf72df89073",
				//   "workspace": "Main Workspace"
				// }

				// console.log("aaa");

				// $.ajax({
				//   url: "https://api.rebrandly.com/v1/links",
				//   type: "post",
				//   data: JSON.stringify(linkRequest),
				//   headers: requestHeaders,
				//   dataType: "json",
				//   success: (link) => {
				//     console.log(`Long URL was ${link.destination}, short URL is ${link.shortUrl}`);
				//   }
				// });


			});
		</script>

	</head>
	<body>
		
	</body>
</html>