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
		$sql_selectUser_command="SELECT Id FROM  USER WHERE email ='".$val."'";
		$jsonTakeData = getUserDataJson($sql_selectUser_command);
		$jsonGetData = json_decode($jsonTakeData);
		for($i=0;$i<sizeof($jsonGetData);$i++)
		{
				$userID=$jsonGetData[$i]->Id;
		}

		//Taking Comics Information From DataBaseLoad/DataBaseLoad_Comics
		$sql_selectComics_command ="SELECT comicsId FROM  COMICS WHERE authorId =".$userID."";
		$jsonTakeData = getUserDataJson($sql_selectComics_command);
		$jsonGetData = json_decode($jsonTakeData);
		$comicsID=array();
		for($i=0;$i<sizeof($jsonGetData);$i++)
		{
				$comicsID[$i]=$jsonGetData[$i]->comicsId;
		}
		//End of Taking Infrormation From DataBaseLoad/DataBaseLoad_Comics
		$dirName="Profile/Users/".$userID."/";
		function deleteDirectory($targetDir)
		{
			if(is_dir($targetDir))
			{
					$files=glob($targetDir.'*',GLOB_MARK);
				foreach($files as $file)
				{
					deleteDirectory($file);
				}
			rmdir($targetDir);
			}
			elseif (is_file($targetDir))
			{
				unlink($targetDir);
			}	
			
		}
		$sql_UserDelete_command ="DELETE FROM USER WHERE Id=".$userID."";
		echo $sql_UserDelete_command;
		if(mysqli_query($conn,$sql_UserDelete_command))
			{	
				if (sizeof($comicsID)>=1)
				{
					for($i=0;$i<sizeof($comicsID);$i++)
						{
							$sql_ComicsUpdate_command ="UPDATE COMICS SET authorId = 1 WHERE comicsId=".$comicsID[$i]."";
							if(mysqli_query($conn,$sql_ComicsUpdate_command))
							{
								deleteDirectory($dirName);
							}
							else
							{	
								echo "ERROR :". $sql_ComicsUpdate_command."".mysqli_error($sql_ComicsUpdate_command);
							}
						}
				}
				else 
				{
					$sql_ComicsUpdate_command ="UPDATE COMICS SET authorId =1 WHERE comicsId=".$comicsID[0]."";
					if(mysqli_query($conn,$sql_ComicsUpdate_command))
							{
								deleteDirectory($dirName);
							}
							else
							{	
								echo "ERROR :". $sql_ComicsUpdate_command."".mysqli_error($sql_ComicsUpdate_command);
							}
					
				}
					
					
					header('Location:LogOut.php');

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