<?php

function abort() {}

$path = "/api";
$query = "?command=getTransactions";

require_once("./api.php");

get_transactions();