<?php
session_start();
require("DataBaseLoad/DataBaseLoad_Comics.php");
if($_SESSION['verification']==1)
{
$comicsName=$_SESSION['comicsName'];
$sql_selectComics_command="SELECT * FROM COMICS WHERE comicsName ='".$comicsName."'";
$jsonTakeData = getComicsDataJson($sql_selectComics_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++)
{
	$cId = $jsonGetData[$i]->comicsId;
	$comicsCount=$jsonGetData[$i]->comicsCount;
}
$target_dir="Profile/Comics/".$comicsName."/Comics/".$_REQUEST['chapterDeleteName1'];
function deleteDirectoryComics($targetDir)
		{
			if(is_dir($targetDir))
			{
				$files=glob($targetDir.'*',GLOB_MARK);
				foreach($files as $file)
				{
					deleteDirectoryComics($file);
				}
			rmdir($targetDir);
			}
			elseif (is_file($targetDir))
			{
				unlink($targetDir);
			}		
		}
function chaptersRename($targetDir)
		{
			$count=0;
			if(is_dir($targetDir))
			{	
				$files=glob($targetDir.'*',GLOB_MARK);
				foreach($files as $file)
					{
						$count++;
						if($count<=9)
						{
							$fileName=explode('/',$file);
							$finalFileName=explode('\\',$fileName[4]);
							rename("Profile/Comics/".$GLOBALS['comicsName']."/Comics/".$finalFileName[0],$GLOBALS['comicsName']." Chapter". " 0".$count);
							
						}
						else 
						{
							$fileName=explode('/',$file);
							$finalFileName=explode('\\',$fileName[4]);
							rename("Profile/Comics/".$GLOBALS['comicsName']."/Comics/".$finalFileName[0],$GLOBALS['comicsName']." Chapter". " 0".$count);
						}	
				}
			}
		}
		
	$sql_Update_command="UPDATE COMICS SET comicsCount =".--$comicsCount." WHERE comicsName ='".$comicsName."'";
	$conn = mysqli_connect("localhost","root","","comicallz");
	if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error());
		}
	if(mysqli_query($conn,$sql_Update_command))
						{
							deleteDirectoryComics($target_dir);
							$direct="Profile/Comics/".$GLOBALS['comicsName']."/Comics/";
							chaptersRename($direct);
							header('Location:Add_Comics.php');
						}
						else
						{
							echo "ERROR :". $sql_ComicsDelete_command."".mysqli_error($sql_deleteComics_command);
						}

}
else
{
	header('location:Main.html');
}
?>