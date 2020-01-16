<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Read Comics</title>
<link rel="stylesheet" href="Design/ReadComics_Design.css">
</head>
<?php
session_start();
require("DataBaseLoad/DataBaseLoad_Comics.php");
require("DataBaseLoad/DataBaseLoad_User.php");
if($_SESSION['verification']==1)
{
$_SESSION['comName']=$_GET['comName'];
//(isset($_GET['searchComics']) ? $_GET['searchComics'] : null);
$sql_selectComics_command="SELECT * FROM COMICS WHERE comicsName ='".$_SESSION['comName']."'";
$jsonTakeData = getComicsDataJson($sql_selectComics_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++)
{
	$cId = $jsonGetData[$i]->comicsId;
	$cName = $jsonGetData[$i]->comicsName;
	$cAuthorId = $jsonGetData[$i]->authorId;
	$cAddDate = $jsonGetData[$i]->uploadedDate;
	$cPicUrl=$jsonGetData[$i]->comicsProPic;
	$cPathUrl=$jsonGetData[$i]->comicsPath;
	$cAbout=$jsonGetData[$i]->comicsAbout;
	$cGenres=$jsonGetData[$i]->genres;
	$comicsCount=$jsonGetData[$i]->comicsCount;
}

$sql_selectUser_command="SELECT * FROM User WHERE email ='".$_SESSION['email']."'";
$jsonTakeData1 = getComicsDataJson($sql_selectUser_command);
$jsonGetData1 = json_decode($jsonTakeData1);
for($i=0;$i<sizeof($jsonGetData1);$i++)
{
	$uId = $jsonGetData1[$i]->Id;
	$uName = $jsonGetData1[$i]->penName;
	$uPicUrl=$jsonGetData1[$i]->proPic;
}

?>
<body>
<div id="full">
<!-- Contianing Full Div Starts -->

<div style="background-color:#BDBDBD" id="upper">
<!-- Contians Upper Div Starts -->

<div id="upper_part1">
<img style="border-radius:15px;" src="<?php echo $uPicUrl ?>" alt="Nothing to Show Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $uName; ?>" width="125" height="100">
</div>

<div id="upper_part2">
<div align="right">
<button style="margin:25px;padding:18px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home </button>
<button style="margin:25px;padding:18px;" name="logOutButton" class="buttons" title="Bye" onclick="location.href='LogOut.php'">Logout</button>
</div>
</div>
<!-- Contians Upper Div Ends -->
</div>


<div id="lower" style="background-color:#848484">
<!-- Contians Upper Div Starts -->

<div id="lower_comicsInfo_container" style="background-color:#848484">
<!-- Contians All Information about Comics Starts -->

<div id="lower_comicsInfo_container_left">
<!-- Contains Profile Picture of Comics Starts -->
<div align="right">
<img src="<?php echo $cPicUrl; ?>" alt ="No Profile Image was Added" title="<?php echo $cName;?>" width="280" height="255">
</div>
<!-- Contains Proile Picturs of Comics Ends-->
</div>

<div id="lower_comicsInfo_container_right">
<!-- Contains Comics Information Starts-->
<table>
<tr>
<td>Comics Id</td>
<td>: <?php echo $cId;?></td>
</tr>
<tr>
<td>Comics Name</td>
<td>: <?php echo $cName;?></td>
</tr>
<tr>
<td>Author</td>
<td>: <?php echo $uName;?></td>
</tr>
<tr>
<td>Release Date</td>
<td>: <?php echo $cAddDate;?></td>
</tr>
<tr>
<td>Genres</td>
<td>: <?php echo $cGenres;?></td>
</tr>
<tr>
<td>Available Chapters</td>
<td>: <?php echo $comicsCount; ?></td>
</tr>
<tr>
<td>Reading Direction</td>
<td>: Left to Right</td>
</tr>
</table>
<!-- Contians All Information about Comics Ends -->
</div>

<!-- Contians Upper Div Ends -->
</div>

<div id="lower_comicsAbout_container" >
<!-- Contains About information of Comics Starts-->
<h2 style="color:#BDBDBD">Read About <?php echo $cName;?> </h2>
<?php echo $cAbout ?>
<!-- Contains About information of Comics Ends-->
</div>

<!-- Comics Directories and Images to Read Starts -->
<div id="lower_comicsElement_container">
<center>
<h3 style ="color:brown">Start Reading your Comics</h3>
<?php
$fileDir="Profile/Comics/".$cName."/Comics/";
$fileName=array();
$finalFileName=array();
echo '<select name="fileRead" onChange="loadImage(this)">';
$fileCount=0;
if(is_dir($fileDir))
			{
				$files=glob($fileDir.'*',GLOB_MARK);
				foreach($files as $file)
				{
					$fileName = explode("/",$file);
					$finalFileName = explode('\\',$fileName[4]);
					echo '<optgroup label="'.$finalFileName[0].'">';
					
					$fileSubDir=$fileDir.$finalFileName[0]."/";
					if(is_dir($fileSubDir))
					{
						$filesSub=glob($fileSubDir.'*',GLOB_MARK);
						
						foreach ($filesSub as $fileSub)
						{
							//It will Load First Image on the page without Using JavaScript
							if($fileCount==0)
							{
								$url=$fileSub;
								$fileCount=1;
							}
							$fileShowName = explode("/",$fileSub);
							$fileShowName1= explode (".",$fileShowName[5]);
							$fileComicsName = $fileShowName[4]." Page ".$fileShowName1[0];
							echo '<option value="'.$fileSub.'">'.$fileComicsName.'</option>';
						}
					}
					echo '</optgroup>';
				}
			}
echo '</select><br><br><br>';
?>
<!-- Load Images to Reader to Read Comics Starts-->
<script>
function loadImage (take)
{
	var image =document.getElementById("showComicsImage");
	image.src=take.value;
}
</script>
<img id="showComicsImage" src="<?php echo $url ?>" width="800" height="800" >
</center>
<!-- Load Images to Reader to Read Comics Ends-->
</div>
<!-- Comics Directories and Images to Read Ends -->

<!-- Contianing Full Div Ends -->
</div>
<?php
}
else 
{
	header('location:Main.html');
}
?>
</body>
</html>