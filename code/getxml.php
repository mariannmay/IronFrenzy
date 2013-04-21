<xml>

<?php
$earthrad = 6371;

$line = $_POST["str"];
$arr = explode("|", $line);
$count = 0;

$con = mysql_connect("localhost", "test", "ieigfyxbr");
if(!$con)
	echo "<error><message>Cannot connect to database!</message></error>";
mysql_select_db("flighttest", $con);

foreach($array as $code) {
	$qry = "select routes.rt_code, routes.airline, routes.ac_name, routes.wp_from, routes.wp_to, aircrafts.cruise_speed, aircrafts.fuel_pp from routes inner join aircrafts on routes.ac_name=aircrafts.ac_name where rt_code = $code;";
	$route  = mysql_query($qry, $con);
	$row = mysql_fetch_assoc($route);
	if(!$row)
		echo "<error><text>No route $code found!<text></error>"
	}
	else {
		$airports[$count++] = $row["wp_from"];
		$airports[$count++] = $row["wp_to"];
		
		echo "<route>"
		echo "<code>$cow</code>"
		echo "<from>".$row["wp_from"]."</from>";
		echo "<to>".$row["wp_to"]."</to>";
		$fc = 0;
		$query = "select route_details.num_in_route, waypoints.longtitude, waypoints.latitude from route_details inner join waypoints on route_details.wp_code=waypoints.wp_code where route_details.rt_code = '".$row["rt_code"]."';";
		$details = mysql_query($query, $con);

		$j=0;
		$time = 0;
		$fuel = 0;
		while($rr = mysql_fetch_assoc($details)) {
			$longt[$j] = deg2rad($rr["longtitude"]);
			$lat[$j] = deg2rad($rr["latitude"]);
			if($j > 0) {
				$dist[$j] = $earthrad*acos(sin($longt[$j])*sin($longt[$j-1]) + cos($longt[$j])*cos($longt[$j-1])*cos($lat[$j]-$lat[$j-1]));
				$time[$i] += $dist[$j] / $row["cruise_speed"];
				$fuel[$i] += $dist[$j] * $row["fuel_pp"] / $row["cruise_speed"] / 100;
			}
			$j++;
		}
		
		$fl = $row["fuel_pp"] / $row["cruise_speed"] / 100 / 60; //per MINUTE!
		
		echo "<fuel>$fuel</fuel>";
		echo "<fl_pm>$fl</fl_pm>";
		echo "<time>$time</time>"
		echo "</route>";
	}
	
	$airports = array_unique($airports);
	$query = "select * from airports";
	$arp = mysql_query($query, $con);
	
	while($row = mysql_fetch_assoc($arp)) {
		echo "<airport>";
		echo "<code>".$row["wp_code"]."</code>";
		echo "<name>".$row["name"]."</name>";
		echo "</airport>";
	}
?>
</xml>