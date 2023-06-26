<?php
$server = "http://localhost:4433/bitcoin_simulation";

$data = $_POST;

$data = base64_encode(json_encode($data));
$res = file_get_contents($server."/blockchain/security/check.php?data=".$data);

if($res=='fail') {
    echo "인증 실패";
}
else if($res=='success') {
    echo "인증 성공";
}

?>