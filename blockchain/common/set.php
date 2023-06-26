<?php
$db = mysqli_connect('localhost', 'root', '', 'bitcoin_simulation');

if($_GET['new_code']) {         # 식별자 추가 필요 
    $sql = "update blockchain set code='".$_GET['new_code']."'";
    mysqli_query($db, $sql);
}
?>
