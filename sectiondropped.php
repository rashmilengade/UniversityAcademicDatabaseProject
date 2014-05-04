<?php
	
		session_start();
		$link = mysql_connect('localhost', 'root', 'lakers');
		mysql_select_db("database_project") or die("Cannot select the database");     
?>
<html>
<head> </head>
<body>
<form method="get" name="Drop_form" action="mainStudent.php" >
<?php 
if(!empty($_GET["selectedSection"]))
	$selectedSection = $_GET["selectedSection"];
if(sizeof($selectedSection) > 0 )
{
	for($i = 0; $i<sizeof($selectedSection) ; $i++)
	{
	//echo $selectedSection[$i];
				$value = explode(",", $selectedSection[$i]);
		$dQuery = "DELETE FROM GRADE_REPORT WHERE SID = '".$value[1]."' AND  SECTIONID = '".$value[0]."'";

										mysql_query($dQuery);
		}
	}

echo "Section Dropped";

?>
<input type="submit" name="back" value="back" />
</form>
</body>
</html>