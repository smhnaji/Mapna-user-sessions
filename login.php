<?php

include 'common.php';
include 'header.php';

session_start();

$name = $_SESSION['name'] ?: $_GET['name'] ?: ('unknown-user-' . rand(1, 10));

$_SESSION['name'] = $name;
$_SESSION['app'] = 'mapna_session_management';

echo 'Hi, you are logged in as ' . $_SESSION['name'] . '!';

include 'footer.php';