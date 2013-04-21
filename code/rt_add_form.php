<html>
<body>
<form method="post" action="rt_add.php">
Route name: <input type="text" name="rt_code"> <br>
Route waypoints: <input type="text" name="wp_codes"> <br>
Airline: <input type="text" name="airline">
Plane: <select name="airplane">
<?php
$con = mysql_connect("localhost", "test", "ieigfyxbr");
if($con) {
	mysql_select_db("flighttest", $con);
	$query = "SELECT ac_name FROM airplanes;";
	$result = mysql_query($result, $con);
	while($row = mysql_fetch_assoc()) {
		echo "<option value='".$row["ac_name"]."'>".$row["ac_name"]."</option>";
	}
}
mysql_close($con);
?>
</select>
<input type="submit">
</form>
</body>
</html>