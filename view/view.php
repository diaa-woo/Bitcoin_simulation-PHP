<form method=post action=view.php>
    <select name="name">
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'bitcoin_simulation');
            $query = "select * from bitcoins group by name";
            $result = mysqli_query($conn, $query);

            while($row=mysqli_fetch_assoc($result)) {
                if(isset($_POST['name'])) {
                    if($_POST['name'] == $row['name']) {
                        echo "<option value='".$row['name']."'selected=\"selected\">".$row['name']."</option>";
                    }
                    else {
                        echo "<option value='".$row['name']."'>".$row['name']."</option>";
                    }
                }
                else {
                    echo "<option value='".$row['name']."'>".$row['name']."</option>";
                }
            }
        ?>
    </select>
    <input type=submit value=확인>
</form>

<?php
    if(isset($_POST['name'])) {
        $select_query = "select * from bitcoins where name='".$_POST['name']."' order by `key` DESC limit 1";
        $select_result = mysqli_query($conn, $select_query);
        $arr = mysqli_fetch_array($select_result);
        echo "현재 가격 : ".$arr['price']."원";
    }
    include 'viewGraph.php';
    
?>