<?php
	
	// function to make all the cURL requests
	// NOTE: this is a hack and does not work if the IP of our server is blocked by cloudflare.
	// uncomment the code below to test on localhost
	// function call($uri, $isPost = false, $data = null) {		
	// 	// NOTE: to bypass cloudflare, we need to immitate web browsers
	// 	// -> capture cf cookies in a local file and plant them in requests
	// 	// -> plant headers from browsers (INCLUDING SECURITY HEADERS!)

	// 	$cookieFile = __DIR__.'/cookies.txt';

	// 	if (!file_exists($cookieFile)) {
	// 		touch($cookieFile);
	// 		chmod($cookieFile, 0666);
	// 	}

	// 	$headers = [
	// 		'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
	// 		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
	// 		'Accept-Language: en-US,en;q=0.5',
	// 		'Accept-Encoding: gzip, deflate, br',
	// 		'Cache-Control: no-cache',
	// 		'Connection: keep-alive',
	// 		'Sec-Fetch-Dest: document',
	// 		'Sec-Fetch-Mode: navigate',
	// 		'Sec-Fetch-Site: none',
	// 		'Sec-Fetch-User: ?1',
	// 		'Upgrade-Insecure-Requests: 1',
	// 		'sec-ch-ua: "Not A(Brand";v="99", "Google Chrome";v="121"',
	// 		'sec-ch-ua-mobile: ?0',
	// 		'sec-ch-ua-platform: "Windows"'
	// 	];

	// 	$curl = curl_init();

	// 	// handling post req
	// 	if ($isPost) {
	// 		$headers[] = 'Content-Type: application/x-www-form-urlencoded';
	// 		curl_setopt($curl, CURLOPT_POST, true);
	// 		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	// 	}

	// 	curl_setopt($curl, CURLOPT_URL, $uri);
	// 	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	// 	curl_setopt($curl, CURLOPT_ENCODING, '');
		
	// 	curl_setopt($curl, CURLOPT_COOKIEJAR, $cookieFile);
	// 	curl_setopt($curl, CURLOPT_COOKIEFILE, $cookieFile);

	// 	// SECURITY HEADERS
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // basically the -k option
		
	// 	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
	// 	curl_setopt($curl, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
	// 	curl_setopt($curl, CURLOPT_SSL_CIPHER_LIST, 'TLS_AES_128_GCM_SHA256,TLS_AES_256_GCM_SHA384,TLS_CHACHA20_POLY1305_SHA256,ECDHE-ECDSA-AES128-GCM-SHA256,ECDHE-RSA-AES128-GCM-SHA256,ECDHE-ECDSA-AES256-GCM-SHA384,ECDHE-RSA-AES256-GCM-SHA384,ECDHE-ECDSA-CHACHA20-POLY1305,ECDHE-RSA-CHACHA20-POLY1305,ECDHE-RSA-AES128-SHA,ECDHE-RSA-AES256-SHA,AES128-GCM-SHA256,AES256-GCM-SHA384,AES128-SHA,AES256-SHA');

	// 	$server_output = curl_exec($curl);
		
	// 	curl_close($curl);

	// 	return $server_output;
	// }


	// method to use on prod, when the proxy is not blocked by CF.
	function call($uri, $isPost = false, $data = null) {		
		

		$curl = curl_init();

		// handling post req
		if ($isPost) {
			$headers[] = 'Content-Type: application/x-www-form-urlencoded';
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		}

		curl_setopt($curl, CURLOPT_URL, $uri);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_ENCODING, '');

		$server_output = curl_exec($curl);
		
		curl_close($curl);

		return $server_output;
	}

	function get_token() {
		return isset($_COOKIE['authToken']) ? strip_tags($_COOKIE['authToken']) : null;
	}
