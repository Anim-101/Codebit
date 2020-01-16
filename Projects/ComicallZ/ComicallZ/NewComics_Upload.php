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
//Gathering Author Data by Session and Json Finishes

//Catching the date and time of comics that's going to be Uploaded Starts
ob_start();
echo date("Y-m-d");
$comicsUploadedDate = ob_get_contents();
ob_end_clean();
//Catching the date and time of comics that's going to be Uploaded Ends

$cName=trim($_REQUEST['comicsName']);
$target_dir_name="Profile/Comics/".$cName;
mkdir($target_dir_name);
$target_dir_pic=$target_dir_name."/Information/";
echo $target_dir_pic . "<br>";
$picName=$target_dir_pic."". $_FILES['picToUpload']['name'];
mkdir($target_dir_pic);
mkdir($target_dir_name."/Comics/");
$target_dir_files=$target_dir_name."/Comics/".$cName." Chapter 01/";
echo $target_dir_files . "<br>";
mkdir($target_dir_files);


//Dealing to With Files Starts

$valid_formats=array("jpg", "png", "gif");
$fileVal=1;
//Cover Picture Upload Procedure for Comics Starts
if (file_exists($picName))
{
	echo "Sorry ComicallZian Files are Already Existed";
	$fileVal=0;
}
if ($_FILES['picToUpload']['size']>10000000)
{
	echo "Sorry".$_FILES['picToUpload']['name']."Too Big Bro";
	$fileVal=0;
}

if($fileVal==1)
{
	if(move_uploaded_file($_FILES["picToUpload"]["tmp_name"], $target_dir_pic.$_FILES['picToUpload']['name']))
	{
		//Inserting Information Into Table Begins
		$selectVal=$_POST['selectGenre'];
		$sql_Insert_command="INSERT INTO COMICS (authorId,comicsName,comicsPath,comicsProPic,comicsAbout,genres,uploadedDate,comicsCount) VALUES(".$aId.",'".trim($_REQUEST['comicsName'])."','".$target_dir_name."','".$target_dir_pic.$_FILES['picToUpload']['name']."','".trim($_REQUEST['comicsAbout'])."','".$selectVal."','".$comicsUploadedDate."',1);";

		$conn = mysqli_connect("localhost","root","","comicallz");
		if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error($conn));
		}
		if(mysqli_query($conn,$sql_Insert_command))
			{	
				header('location:Add_Comics.php');
			}
		else
		{
			echo "ERROR :". $sql_Insert_command."".mysqli_error($conn);
		}
		mysqli_close($conn);
		//Inserting Information Into Table Finishes
	}
	
}
else
{
	echo "Sorry ComicallZian It's not your fault but your Comic's Profile Pic is";
}
	



//Uploading Files into Directed Comics's Folder Begins
$maxFileSize=1014*1048576;//600kb As it's Sorting in Folder
$count=0;//Default Counter to Counte Inserted Value
$default=array();//Variable to Change the Name of uploaded files
if(isset($_POST)and $_SERVER['REQUEST_METHOD']=="POST")
{
	$i=0;
	foreach ($_FILES['filesToUpload']['name']as $f=> $name)
	{
		$default = explode(".",$name);
		if($i<=9)
		{
			$name="0".$count.".".$default[1];
			$i++;
		}
		else 		{
			$name=$count.".".$default[1];
		}
		if($_FILES['filesToUpload']['error'][$f]==4)
		{
			$message="$name Contains Error";
			echo $message;
			continue; //Skips Image 
		}
		if ($_FILES['filesToUpload']['size'][$f]>$maxFileSize)
		{
			$message="$name is too Large than our Server Bro";
			echo $message;
			continue; //Larger than the value that was set ! Skips
		}
		
		else if (! in_array(pathinfo($name,PATHINFO_EXTENSION),$valid_formats))
		{
			$message="$name is not a Valid Format";
			echo $message;
			continue; //Invalid Format ! Skips
		}
		else //No Error Found By Upper Conditions then It's On
		{
			if(move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$f],$target_dir_files.$name))
			{
				$count++;
			}
		}
//Uploading Files into Directed Comics's Folder Finishes
	}
}
}
else 
{
	header('location:Main.html');
}
?>