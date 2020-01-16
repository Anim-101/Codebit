<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
if($_SESSION['verification']==1)
{
$emailAuthor=$_SESSION['email'];
//Gathering Author Data by Session and Json Begins
$sql_Select_command="SELECT Id FROM  USER WHERE email ='".$emailAuthor."'";
$jsonTakeData = getUserDataJson($sql_Select_command);
$jsonTakeData = getUserDataJson($sql_Select_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++){
		$aId=$jsonGetData[$i]->Id;
}
$rootPath="Profile/Users/";
if (!file_exists($rootPath.$aId))
{
    mkdir($rootPath.$aId, 0777, true);
	if(move_uploaded_file($_FILES["proPicToUpload"]["tmp_name"], $rootPath.$aId."/".$_FILES['proPicToUpload']['name']))
	{
		$sql_Insert_command="UPDATE USER SET proPic='".$rootPath.$aId."/".$_FILES['proPicToUpload']['name']."' WHERE Id=".$aId."";
		$conn = mysqli_connect("localhost","root","","comicallz");
		if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error($conn));
		}
		if(mysqli_query($conn,$sql_Insert_command))
			{	
				header('Location:User.php');
			}
		else
		{
			echo "ERROR :". $sql_Insert_command."".mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
else
{
	if(move_uploaded_file($_FILES["proPicToUpload"]["tmp_name"], $rootPath.$aId."/".$_FILES['proPicToUpload']['name']))
	{
		$sql_Insert_command="UPDATE USER SET proPic='".$rootPath.$aId."/".$_FILES['proPicToUpload']['name']."' WHERE Id=".$aId."";
		$conn = mysqli_connect("localhost","root","","comicallz");
		if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error($conn));
		}
		if(mysqli_query($conn,$sql_Insert_command))
			{	
				header('Location:User.php');
			}
		else
		{
			echo "ERROR :". $sql_Insert_command."".mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
}
else
{
	header('location:Main.html');
}
?>