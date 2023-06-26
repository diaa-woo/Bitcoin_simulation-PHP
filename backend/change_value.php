<?php
$coin_name=$_GET['coin_name'];
$coin_count = $_GET['coin_count'];

$conn = mysqli_connect('localhost', 'root', '' ,'bitcoin_simulation');
$query = "select * from bitcoins where name='".$_GET['coin_name']."' order by `key` DESC limit 1";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    if($row['name'] == $coin_name) {
        $update_count = $row['counts'] - $coin_count;
        $update_price = $row['total'] / ($update_count);
        $update_query = 
            "Insert into bitcoins (name, price, counts, total, dates) values ('".
            $coin_name."'".
            ", ".$update_price.
            ", ".$update_count.
            ", ".$row['total'].
            ", "."'".date("Y-m-d", strtotime("-1 week -4 days"))."')";
        echo $update_query;
        mysqli_query($conn, $update_query);
    }
}
?>