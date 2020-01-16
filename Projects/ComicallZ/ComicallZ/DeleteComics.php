<?php
session_start();
require("DataBaseLoad/DataBaseLoad_Comics.php");
require("DataBaseLoad/DataBaseLoad_User.php");
if($_SESSION['verification']==1)
{
	$deleteComics = $_GET['comName'];
	echo $deleteComics;
	$sql_deleteComics_command="DELETE FROM COMICS WHERE comicsName ='".$deleteComics."'";
	$conn = mysqli_connect("localhost","root","","comicallz");
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
		if(!$conn)
		{
			die("Connection Failed : ". mysqli_connect_error());
		}
		if(mysqli_query($conn,$sql_deleteComics_command))
						{
								$dirName="Profile/Comics/".$deleteComics."/";
								$dirName1="Profile/Comics/".$deleteComics."/Comics/";
								$dirName2="Profile/Comics/".$deleteComics."/Information/";
								deleteDirectoryComics($dirName1);
								deleteDirectoryComics($dirName2);
								deleteDirectoryComics($dirName);
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