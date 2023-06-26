<?php
    $conn = mysqli_connect('localhost', 'root', '', 'bitcoin_simulation');
    $query = "select * from bitcoins where name='".$_GET['name']."'";
    $result = mysqli_query($conn, $query);

    while($row=mysqli_fetch_assoc($result)) {
        $dataset['label'];
    }
?>