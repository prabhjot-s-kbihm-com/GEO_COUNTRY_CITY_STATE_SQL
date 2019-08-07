<?
	include("db.php");

	$countryID 	= (isset($_GET["c"])) ? substr(preg_replace('/[^A-Z]/', '', $_GET["c"]), 0, 3) : "";
	$stateID 	= (isset($_GET["s"])) ? intval($_GET["s"]) : -1;
	
	if ($stateID != -1 && $countryID) 	$sql = "SELECT cityID as idx, cityName as nme FROM cities WHERE stateID = '$stateID' && countryID = '$countryID' ORDER BY cityName";
	elseif ($countryID) 				$sql = "SELECT stateID as idx, stateName as nme FROM states WHERE countryID = '$countryID' ORDER BY stateName";
	else die();
	
	
	$result = $mysqli->query($sql);
	
	// result in format JSON
	$tmp  = "{\n";
	
	if ($result->num_rows)
	{	
		while ($row = $result->fetch_object())
			$tmp .= '"0'.$row->idx.'" : "' . str_replace("\'", "'", $row->nme) . '",'."\n";
		$tmp = rtrim($tmp, ",\n ");
	}
	elseif ($stateID == -1) $tmp .= '"0" : " - No States - "';
	else $tmp = rtrim($tmp, "\n ");
	
	$tmp .= "\n}";
	
	$result->close();
	$mysqli->close();
	
	header('Content-type: application/json; charset=utf-8');
	header('Content-Length: ' . strlen($tmp));
	
	echo $tmp;
	
	return true;
?>