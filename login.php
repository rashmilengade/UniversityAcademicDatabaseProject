<?php

	session_start();
 	/*	 Step #1: Open connection to the MySQL database */
	$link = mysql_connect('localhost', 'root', 'lakers') or die("Connection Failed");
	mysql_select_db("database_project") or die("Database not selected");     
	
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Students Registered for a given course</title>
</head>
 <body>


 <h2>*** WELCOME *** </h2><br/>
    <form method="get" name="login_form" action="login.php" >
 
 
  <table>
    <tr><td>
    <input type="radio" name="userType" value="Staff">Staff
    </td>
    <td>
    <input type="radio" name="userType" value="Student">Student
    </td>
    </tr>
    
    <tr>
    <td>
        <h4>NetId</h4>
    </td>
    <td>
    <input name="netId" type="text"  size="60" />
    </td>
    </tr>
    
    <tr>
    <td>
    <h4>Password</h4>
    </td>
    <td>
    <input name="password" type="password" size="60" />
    
    </td>
    </tr>
    <tr>
    <td>
    <input type="submit" value="LOGIN">
    </td>
    </tr>
    </table><br/>
    <br/>
  <?php 
	if(!isset($_GET["netId"]) || !isset($_GET["password"]))
	{
		exit;
	}
      
   if($_GET["userType"] == "Staff")
   {
   		$query = "SELECT PASSWORD,NETID,SSN,FNAME,LNAME FROM STAFF WHERE  NETID = '".$_GET["netId"]."'";
   		
   		$result = mysql_query($query);
   		
  		 while($row = mysql_fetch_assoc($result))
   		{
   				
  			 	if($row['PASSWORD'] == $_GET["password"] & $row['NETID'] == $_GET["netId"])
   				{
   					$_SESSION["SSN"] = $row['SSN'];
   					$_SESSION["fname"] = $row['FNAME'];
					$_SESSION["lname"] = $row['LNAME'];
   					$url = "mainStaff.php?";
   					header("Location: $url");
   				}
   				else
   				{
   					echo "Login Unsuccessful...!! Please Try Again..!!";
   				}
   
  		 }
  		 
  		 
   }
   else 
	{
		$query = "SELECT PASSWORD,NETID,SID,FNAME,LNAME FROM STUDENT WHERE  NETID = '".$_GET["netId"]."'";
		
		$result = mysql_query($query);
		 
		while($row = mysql_fetch_assoc($result))
		{
			 
			if($row['PASSWORD'] == $_GET["password"] & $row['NETID'] == $_GET["netId"])
			{
				$_SESSION["SID"] = $row['SID'];
				$_SESSION["fname"] = $row['FNAME'];
				$_SESSION["lname"] = $row['LNAME']; 
				$url = "mainStudent.php?";
   					header("Location: $url");
   				}
   	
			else
			{
				
				echo "Login Unsuccessful...!! Please Try Again..!!";
 			}
			 
		}	
	}
    ?> 
   </form> 
</body>

</html>