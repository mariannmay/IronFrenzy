<html>
<body>
<?php

$wp_code = $_POST["wp_code"];
$longtitude_s = $_POST["longtitude"];
$latitude_s = $_POST["latitude"];

if(!is_numeric($longtitude_s)) {
	echo "Longtitude must be a number!";
}
elseif(!is_numeric($latitude_s)) {
	echo "Latitude must be a number!";
}
else {
	$con = mysql_connect("localhost", "test", "ieigfyxbr");
	if($con) {
		mysql_select_db("flighttest", $con);
		$query = "INSERT INTO waypoints VALUES ('$wp_code', $longtitude_s, $latitude_s);";
		if (!mysql_query($query, $con))
			die('Error: ' . mysql_error($con));
		echo "Record added";
	}
	mysql_close($con);
}

?>
</body>
</html>