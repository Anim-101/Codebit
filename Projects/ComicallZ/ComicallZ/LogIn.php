<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
/*
//Decoding/Encoding Hasing Sha256 Starts !
$sql_selectSalt_command="SELECT salt from user where email'".$_REQUEST['email']."'";
$result = mysqli_query($sql_selectSalt_command);
$row = mysqli_fetch_assoc($result);
$salt = $row['salt'];
$saltedPassword =$_REQUEST['password'].$salt;
$hashedPassword= hash('sha256',$saltedPassword);
//Decoding/Encoding Hasing Sha256 Ends !
*/
$sql_LogIn_command="SELECT * FROM USER WHERE email='".$_REQUEST['email']."' and password='".$_REQUEST['password']."'";
$jsonTakeData = getUserDataJson($sql_LogIn_command);

$jsonGetData = json_decode($jsonTakeData);

if (sizeof($jsonGetData)>0)
	{
		for($i=0;$i<sizeof($jsonGetData);$i++)
		{
			if($i==0)
			{
				$_SESSION['email']=$_REQUEST['email'];
				$_SESSION['verification']=1;
				header('Location:MainFeed.php');
				
				
			}
			else 
			{
				echo "<p>Some Error</p>";
				header('Location:LogIn.html');
			}
		}
	}
else 
			{
				echo "<p>Some Error</p>";
				header('Location:LogIn.html');
			}
?>