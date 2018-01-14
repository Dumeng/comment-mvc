<?php

define('ROOT', getcwd());

include ROOT . '/includes/db.php';
include ROOT . '/includes/bootstrap.php';

$client = new Client();
$client->display();
