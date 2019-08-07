<?
	include("db.php");
	
	$sql 	= "SELECT countryID, countryName FROM countries ORDER BY countryName";
	$result = $mysqli->query($sql);

	
	$tmp = "<html>\n";
	$tmp .= "<head>\n";
	$tmp .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>\n";
	$tmp .= "<script src='scripts.js' type='text/javascript' charset='utf-8'></script>\n";
	$tmp .= "</head>\n";
	$tmp .= "<body style='color:#444444;'>\n";
	
	
	$tmp .= "<form action='countries.php' method='post' accept-charset='UTF-8'>\n";
	$tmp .= "<table style='margin: 100px 0 0 300px' cellspacing='15'><tr>\n";

	if (isset($_POST["country"]))
		$tmp .= "<td colspan='2'>Debug - Submitted Data -<br><br>\$_POST[country] = " . $_POST['country'] . "<br>\$_POST[state] = " . (isset($_POST['state'])?$_POST['state']:"") . "<br>\$_POST[city] = " . $_POST['city'] . "<br><br><br></td></tr><tr>";
	
	$tmp .= "<td>Country:</td>\n";
	$tmp .= "<td><select id='country' name='country'>\n";
	$tmp .= "<option value=''> - Select Country - </option>\n";
		
	while ($row = $result->fetch_object())
		$tmp .= "<option value='$row->countryID'".(isset($_POST['country']) && $_POST['country']==$row->countryID?" selected='selected'":"").">$row->countryName</option>\n";
	
	$tmp .= "</select>\n";
	$tmp .= "<span class='country-icon'></span></td>\n";
	
	$tmp .= "</tr><tr>\n";
	
	$tmp .= "<td>State:</td>\n";
	$tmp .= "<td><select id='state' name='state'".(isset($_POST['state']) && intval($_POST['state'])?" sel='".intval($_POST['state'])."'":"").">\n";
	$tmp .= "</select></td>\n";
	
	$tmp .= "</tr><tr>\n";
	
	$tmp .= "<td>City:</td>\n";
	$tmp .= "<td><select id='city' name='city'".(isset($_POST['city']) && intval($_POST['city'])?" sel='".intval($_POST['city'])."'":"").">\n";
	$tmp .= "</select></td>\n";
	
	$tmp .= "</tr><tr>\n";
	
	$tmp .= "<td colspan='2'><br><input type='submit' value='Submit'> &#160; <input onclick='window.location=\"countries.php\"' type='reset' value='Reset'></td>";
	
	$tmp .= "</tr></table>\n";
	$tmp .= "</form>\n";
	$tmp .= "</body>\n";
	$tmp .= "</html>";
	
	$result->close();
	$mysqli->close();
	
	echo $tmp;
?>
