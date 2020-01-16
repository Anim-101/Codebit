<?php
require("DataBaseLoad/DataBaseLoad_User.php");
session_start();
$conn=mysqli_connect("localhost","root","","comicallz");
//Catching that time ! what a rush ->Starts!!
ob_start();
echo date("l jS \of F Y h:i:s A");
$join_date = ob_get_contents();
ob_end_clean();
//Catching that time ! what a rush ->Starts!!

//Catching date and time in different format to calculate Member Since in MainFeed.php Page Starts
ob_start();
echo date("Y-m-d");
$member_join_date = ob_get_contents();
ob_end_clean();
//Catching date and time in different format to calculate Member Since in MainFeed.php Page Ends
/*
//Hasing with Sha256 technique->Password Starts
$salt = bin2hex(mycrpt_create_iv(32,MYCRYPT_DEV_RANDOM));
$saltPassword = $_REQUEST['password'].$salt;
$hasedPassword=hash('sha256',$saltPassword);
//Hashing with Sha256 technique->Password Ends
 */
$sql_insert_command="INSERT INTO USER (firstName,lastName,penName,password,email,joinDate,memberSince,salt) VALUES('".$_REQUEST['firstName']."','".$_REQUEST['lastName']."','".$_REQUEST['penName']."','".$_REQUEST['password']."','".$_REQUEST['email']."','".$join_date."','".$member_join_date."','".$salt."')";


if(!$conn)
{
	die("Connection Failed : ". mysqli_connect_error());
}
if(mysqli_query($conn,$sql_insert_command))
	{	
		echo "New Record Created Successfully";
		header('Location:LogIn.html');
	}
else
{
	echo "ERROR :". $sql_insert_command."".mysqli_error($sql_insert_command);
}
mysqli_close($conn);
?>