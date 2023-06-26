<?php
$query_graph = "select * from bitcoins where name='".$_POST['name']."' order by `key` DESC";
$result_graph = mysqli_query($conn, $query_graph);

$result_arr_labels = Array();
$result_arr_datas  = Array();

while($row = mysqli_fetch_assoc($result_graph)) {
	array_push($result_arr_labels,$row['dates']);
	array_push($result_arr_datas, (double)$row['price']);
}

$result_arr_datas = array_reverse($result_arr_datas);
$result_arr_labels = array_reverse($result_arr_labels);

$name = $_POST['name'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Graph</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js"></script>
<script type="text/javascript" charset="utf-8" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

</head>
<body>
<div style="width: 1000px;">
<canvas id="line1"></canvas>
</div>

<script>
// TODO: 왜  을 했을때 문제가 생기는 것인가? 그래프 자체가 표시되질 않는다. 근데 그렇다고 json_encode는 왜 되지? Chart.js에서 못받는 이유가 뭐지?

var ctx = document.getElementById('line1').getContext('2d');

var labels = <?php echo json_encode($result_arr_labels) ?>;
var datas = <?php echo json_encode($result_arr_datas, JSON_NUMERIC_CHECK) ?>;
var chart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: labels ,
		datasets: [
				{
					label: 'coin',
					backgroundColor: 'transparent',
					borderColor: "red",
					data: datas,
				}
		]
	},
	options: {}
});

function forever(){
	var recv  = window.AppInventor.getWebViewString();
	chart.data.datasets[0].data.shift();
	chart.data.datasets[0].data.push(recv);
	//chart.data.labels.shift();
	chart.update();
}
</script>
</body>
</html>
