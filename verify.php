<?php

session_start();
/*	 Step #1: Open connection to the MySQL database */
$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
mysql_select_db("database_project") or die("Database not selected");




$netId	=	$_GET["netId"];
$pass	=	$_GET["password"];
$utype = $_GET["userType"];
$staff = "Staff";
 
if($utype == $staff)
{
	$query = "SELECT PASSWORD FROM STAFF WHERE  NETID = '$netId' ";
	$result = mysql_query($query);
	 
	while($row = mysql_fetch_assoc($result))
	{
		 
		if($row['PASSWORD'] == $_GET["password"])
		{
			$url = "/view_Students.php?user=$netId";
			header( 'Location: $url');
		}
		else
		{
			$url = "login.php";
			header( 'Location: $url');
		}
		 
	}
}
else
{
	$query = "SELECT PASSWORD FROM STUDENT WHERE  NETID = '$netId' ";
	$result = mysql_query($query);
		
	while($row = mysql_fetch_assoc($result))
	{

		if($row['PASSWORD'] == $_GET["password"])
		{
			$url = "Sample2.php?user=$netId";
			header( 'Location: $url');
		}
		else
		{
			$url = "login.php?user=$netId";
			header( 'Location: $url');
		}
	}

}

?>




