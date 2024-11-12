<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Expensify - Transaction Dashboard</title>

	<!-- favicon -->
	<link rel="icon" type="image/png" href="https://d2k5nsl2zxldvw.cloudfront.net/images/expensify__favicon.png" />

	<!-- scripts -->
	<script
	src="https://code.jquery.com/jquery-3.7.1.min.js"
	integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
	crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/utils.js"></script>
	<!-- 3rd party lib for message toasts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<!-- styles -->
	<link rel="stylesheet" type="text/css" href="css/app.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- css for the toast lib included above -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css" integrity="sha512-wJgJNTBBkLit7ymC6vvzM1EcSWeM9mmOu+1USHaRBbHkm6W9EgM0HY27+UtUaprntaYQJF75rc8gjxllKs5OIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<main>
		<div class="window loader text-center hide" id="loader">
			<img 
				src="https://blog.roberthallam.org/wp-content/uploads/2022/09/loading-windows98-transparent2-1.gif" 
				class="inline-block loader" 
				alt="loading..." 
				height="48px" 
			/>
		</div>

		<?php require_once("./partials/login.php"); ?>

		<?php require_once("./partials/dashboard.php"); ?>

	</main>
	<script type="text/javascript" src="js/index.js"></script>
</body>
</html>