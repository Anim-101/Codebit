<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
require("DataBaseLoad/DataBaseLoad_Comics.php");
if($_SESSION['verification']==1)
{
		$conn = mysqli_connect("localhost","root","","comicallz");
		if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error());
		}
		$val=$_SESSION['email'];
		$sql_select_command="SELECT Id FROM  USER WHERE email ='".$val."'";
		$jsonTakeData = getUserDataJson($sql_select_command);
		$jsonGetData = json_decode($jsonTakeData);
		for($i=0;$i<sizeof($jsonGetData);$i++)
		{
				$userID=$jsonGetData[$i]->Id;
		}
		$sql_UserDelete_command ="DELETE FROM USER WHERE Id=".$userID."";
		
		//Slecting Associative Comics Name from Comics Table 
		$sql_selectComics_command="SELECT comicsName from COMICS WHERE authorId=".$userID."";
		$jsonTakeData = getUserDataJson($sql_selectComics_command);
		$jsonGetData = json_decode($jsonTakeData);
		$comName=array();
		for($i=0;$i<sizeof($jsonGetData);$i++)
		{
				$comName[$i]=$jsonGetData[$i]->comicsName;
				echo $comName[$i];
		}
		$dirName="Profile/Users/".$userID."/";
		function deleteDirectoryUser($targetDir)
		{
			if(is_dir($targetDir))
			{
					$files=glob($targetDir.'*',GLOB_MARK);
				foreach($files as $file)
				{
					deleteDirectoryUser($file);
				}
			rmdir($targetDir);
			}
			elseif (is_file($targetDir))
			{
				unlink($targetDir);
			}		
		}
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
		if(mysqli_query($conn,$sql_UserDelete_command))
			{	
				deleteDirectoryUser($dirName);
				if(sizeof($comName)>=1)
				{
					for($i=0;$i<sizeof($comName);$i++)
					{
						$sql_ComicsDelete_command ="DELETE FROM COMICS WHERE comicsName='".$comName[$i]."'";
						if(mysqli_query($conn,$sql_ComicsDelete_command))
						{
								$dirName="Profile/Comics/".$comName[$i]."/";
								$dirName1="Profile/Comics/".$comName[$i]."/Comics/";
								$dirName2="Profile/Comics/".$comName[$i]."/Information/";
								deleteDirectoryComics($dirName1);
								deleteDirectoryComics($dirName2);
								deleteDirectoryComics($dirName);
								header('Location:LogOut.php');
						}
						else
						{
							echo "ERROR :". $sql_ComicsDelete_command."".mysqli_error($sql_ComicsDelete_command);
						}
					}
				}
				else 
				{
					$sql_ComicsDelete_command ="DELETE FROM COMICS WHERE authorId=".$userID."";

					if(mysqli_query($conn,$sql_ComicsDelete_command))
						{
								$dirName="Profile/Comics/".$comName[0]."/";
								$dirName1="Profile/Comics/".$comName[0]."/Comics/";
								$dirName2="Profile/Comics/".$comName[0]."/Information/";
								deleteDirectoryComics($dirName1);
								deleteDirectoryComics($dirName2);
								deleteDirectoryComics($dirName);
								header('Location:LogOut.php');
						}
					else
						{
							echo "ERROR :". $sql_ComicsDelete_command."".mysqli_error($sql_ComicsDelete_command);
						}				
				}						

			}
		else
		{
			echo "ERROR :". $sql_UserDelete_command."".mysqli_error($sql_UserDelete_command);
		}
		mysqli_close($conn);
}
else 
{
	header('Location:Main.html');
}
?>