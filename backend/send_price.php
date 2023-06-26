<?php

$conn = mysqli_connect('localhost', 'root', '', 'bitcoin_simulation');
$query = "SELECT t1.* FROM bitcoins t1 LEFT JOIN bitcoins t2 ON t1.name = t2.name AND t1.key < t2.key WHERE t2.key IS NULL;";
$result = mysqli_query($conn, $query);

$name = array();
$count_i = 0;
$price = array();

while($row = mysqli_fetch_assoc($result)) {
    array_push($name, $row['name']);
    array_push($price, $row['price']);
}

$data = array();

foreach ($name as $value) {
    $data[$value] = $price[$count_i];
    $count_i += 1;
}
  
header('Content-Type: application/json');
echo json_encode($data);
?>