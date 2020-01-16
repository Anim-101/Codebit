<?php
require("DataBaseLoad/DataBaseLoad_User.php");
session_start();
$oldEmail=$_SESSION['email'];
$conn=mysqli_connect("localhost","root","","comicallz");
$sql_selectUser_command="SELECT * FROM  USER WHERE email ='".$oldEmail."'";
$jsonTakeData = getUserDataJson($sql_selectUser_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++){
		$id=$jsonGetData[$i]->Id;
}
$sql_UpdateUser_command="UPDATE USER SET firstName='".$_REQUEST['updateFirstName']."', lastName='".$_REQUEST['updateLastName']."', penName='".$_REQUEST['updatePenName']."', Email ='".$_REQUEST['updateEmail']."', Password='".$_REQUEST['updatePassword']."', About='".$_REQUEST['updateAbout']."' WHERE Id =".$id."";
if(!$conn)
{
	die("Connection failed: " . mysqli_connect_error($conn));
}
if (mysqli_query($conn,$sql_UpdateUser_command))
{
	$_SESSION['email']=$_REQUEST['updateEmail'];
	header("location:MainFeed.php");
}
else
{
	 echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>