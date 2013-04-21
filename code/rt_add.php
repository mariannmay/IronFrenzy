<html>
<body>
<?php

$rtcode = $_POST["rt_code"];
$wpline = $_POST["wp_codes"];
$airline = $_POST["airline"];
$airplane = $_POST["airplane"];

$allright = true;
$wpcodes = split('[/.-]', $wpline);
$len = count($wpcodes);
if($len < 2) {
	echo "Error: there must be at least 2 waypoints!";
	$allright = false;
	}

$con = mysql_connect("localhost", "test", "ieigfyxbr");
if($con) {
	mysql_select_db("flighttest", $con);
	
	foreach($wpcodes as $wpcode) {
		if(mysql_num_rows(mysql_query("select * from waypoints where wp_code='$wpcode'")) == 0) {
			$allright = false;
			echo "Waypoint with code $wpcode doesn't exist! <a href='wp_add_form.html'>Add.</a><br>";
		}
	}
	$wpfrom = $wpcodes[0];
	if(mysql_num_rows(mysql_query("select * from airports where wp_code='$wpfrom'"), $con) == 0) {
		echo "Waypoint $wpfrom must be airport! <br>";
		$allright = false;
	}	
	$wpto = $wpcodes[$len];
	if(mysql_num_rows(mysql_query("select * from airports where wp_code='$wpto'"), $con) == 0) {
		echo "Waypoint $wpto must be airport! <br>";
		$allright = false;
	}
	
	if(mysql_num_rows(mysql_query("select * from routes where rt_code='$rtcode'"), $con) != 0) {
		echo "Route name already taken!";
		$allright = false;
	}
	
	if($allright) {
		mysql_query("insert into routes values ('$rt_code', '$airline', '$airplane', '$wpfrom', '$wpto');");
		for($i = 0; $i<$len; $i++) {
			mysql_query("insert into route_details values ('$rtcode', $i, '".$wpcodes[$i]."')", $con)
		}
		
		echo "Route inserted successflly!";
	}
}
mysql_close($con);

?>
</body>
</html>