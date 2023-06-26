<?php

$db = mysqli_connect('localhost', 'root', '', 'bitcoin_simulation');

$result = true;
$data = json_decode(base64_decode($_GET['data']), 'array');

// Get key
$sql = "select wallet_key from blockchain where wallet_key='".$data['wallet_key']."'";
$res = mysqli_query($db, $sql);
list($key) = $res -> fetch_array();

// Get Code
$check_code = file_get_contents("https://localhost:4433/bitcoin_simulation/blockchain/common/give.php");

$sql = "select wallet_key from blockchain where wallet_key!='".$data['wallet_key']."'";
$res = mysqli_query($db, $sql);
while($row = $res->fetch_array()) {
    unset($code);
    $code = file_get_contents("https://localhost:4433/bitcoin_simulation/blockchain/common/give.php");

    if($check_code!=$code) {
        $result=false;
    }
}

if(!$result) {
    echo "fail";
}
else {
    $new_code = hash('sha256', $data['wallet_key'].$data['name'].$data['counts'].$check_code);

    // deploy new code
    $sql = "select wallet_key from blockchain where 1";
    $res = mysqli_query($db, $sql);
    while($row = $res->fetch_array()) {
        file_get_contents("https://localhost:4433/bitcoin_simulation/blockchain/common/set.php?new_code=".$new_code."\"");
    }

    echo "success";
}

?>