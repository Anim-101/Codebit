<?php
session_start();
require("DataBaseLoad/DataBaseLoad_Comics.php");
if($_SESSION['verification']==1)
{
	$comicsName=explode("Chapter",$_REQUEST['chapterUploadComicsName']);
	echo $comicsName[0];
	$target_dir ="Profile/Comics/".$comicsName[0]."/Comics/".$_REQUEST['chapterUploadComicsName']."/";
	mkdir($target_dir);
	//Taking oldComicsCount to Upadte it 
	$sql_selectCount_command="SELECT comicsCount FROM COMICS WHERE comicsName='".trim($comicsName[0])."'";
	$jsonTakeData = getComicsDataJson($sql_selectCount_command);
	$jsonGetData = json_decode($jsonTakeData);
	for($i=0;$i<sizeof($jsonGetData);$i++)
	{
		$cCount=$jsonGetData[$i]->comicsCount;
	}
	
	//Chapter Checking and Uploading
	//Uploading Files into Directed Comics's Folder Begins
	$maxFileSize=1014*1048576;//100Mb As it's Sorting in Folder
	$count=0;//Default Counter to Counte Inserted Value
	$default=array();//Variable to Change the Name of uploaded files
	$valid_formats=array("jpg", "png", "gif");
	if(isset($_POST)and $_SERVER['REQUEST_METHOD']=="POST")
	{
		$i=0;
		foreach ($_FILES['chapterToUpload']['name']as $f => $name)
		{
			$default = explode(".",$name);
			if($i<=9)
			{
				$name="0".$count.".".$default[1];
				$i++;
			}
			else 		
			{
				$name=$count.".".$default[1];
			}
			if($_FILES['chapterToUpload']['error'][$f]==4)
			{
				$message="$name Contains Error";
				echo $message;
				continue; //Skips Image 
			}
			if ($_FILES['chapterToUpload']['size'][$f]>$maxFileSize)
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
				if(move_uploaded_file($_FILES['chapterToUpload']['tmp_name'][$f],$target_dir.$name))
				{
					$count++;
				}
			}
	//Uploading Files into Directed Comics's Folder Finishes
		}
	}
	
	//Updating Count Comics Information Into Table Begins
	$sql_UpdateCount_command="UPDATE COMICS SET comicsCount =".++$cCount." WHERE comicsName='".trim($comicsName[0])."'";
	$conn = mysqli_connect("localhost","root","","comicallz");
	if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error($conn));
		}
	if(mysqli_query($conn,$sql_UpdateCount_command))
			{	
				header('location:Add_Comics.php');
			}
	else
		{
			echo "ERROR :". $sql_UpdateCount_command."".mysqli_error($conn);
		}
	mysqli_close($conn);
	//Updating Count Comics Into Table Finishes
}
else 
{
	header("location:Main.html");
}
?>