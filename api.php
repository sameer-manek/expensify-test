<?php

	require_once("helpers.php");

	function verify_session () {
		echo get_token() ? 1 : 0;
	}

	function authenticate_user() {
		$uri  = "https://www.expensify.com/api/Authenticate";
		$data = [
			'partnerUserID' 	=> $_POST['partnerUserID'],
			'partnerUserSecret'	=> $_POST['partnerUserSecret'],
			'partnerName' 		=> "applicant",
			'partnerPassword' 	=> "d7c3119c6cdab02d68d9"
		];

		// extract cookie if available
		$response = call($uri, true, $data);
		$json = json_decode($response);

		if ($json->jsonCode === 200 && 
			$json->httpCode === 200) {

			setcookie("authToken", $json->authToken, [
				// [NOTE] setting expires to 1 day but maybe API should return "expiry" to prevent unnecessary hits to main server.
				'expires' => time() + 86400,
				'path' => '/',
				'domain' => $SERVER['HTTP_HOST'],
				'secure' => true,
				'httponly' => true,
				'samesite' => 'Strict'
			]);

			echo json_encode(["success" => true]);
			return;
		}

		echo json_encode(["success" => false, "error_code" => $json->jsonCode]);
		return;
	}

	function get_transactions() {
		$params = [
			"returnValueList" 	=> "transactionList",
			"authToken" 		=> get_token(),
		];

		$uri = "https://www.expensify.com/api/Get?".http_build_query($params);

		echo call($uri);
	}

	function create_transaction() {
		$uri = "https://www.expensify.com/api/CreateTransaction";

		$_POST['authToken'] = get_token();

		echo call($uri, true, $_POST);
	}

	function logout () {
		setcookie('authToken', '', [
			'expires' => time() - 3600,
			'path' => '/',
			'domain' => $SERVER['HTTP_HOST'],
			'secure' => true,
			'httponly' => true,
			'samesite' => 'Strict'
		]);
	}

	// function calling logic
	$functions = [
		'login' 			=> 'authenticate_user',
		'getTransactions' 	=> 'get_transactions',
		'addTransaction'	=> 'create_transaction',
		'verifySession'		=> 'verify_session',
		'logout'			=> 'logout'
	];

	$vars = [];
	parse_str($query, $vars);

	if (array_key_exists('command', $vars) && 
		array_key_exists($vars['command'], $functions) && 
		is_callable($functions[$vars['command']])) {

		$functions[$vars['command']]();		

	} else {
		abort(404);
	}
