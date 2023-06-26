<?php

$db = mysqli_connect("localhost", 'root', '', 'bitcoin_simulation');

$sql = "select code from blockchain limit 1";
$res = mysqli_query($db, $sql);
list($code) = $res->fetch_array();

echo $code;

?>