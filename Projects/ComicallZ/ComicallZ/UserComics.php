<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Hot Comics</title>
<link rel="stylesheet" href="Design/UserComics_Design.css">
</head>
<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
require("DataBaseLoad/DataBaseLoad_Comics.php");
if($_SESSION['verification']==1)
{
$userEmail=$_SESSION['email'];

//Aquiring Data of User Starts
$sql_selectUser_command="SELECT * FROM  USER WHERE email ='".$userEmail."'";
$jsonTakeData = getUserDataJson($sql_selectUser_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++)
{
		$userId=$jsonGetData[$i]->Id;
		$userPenName=$jsonGetData[$i]->penName;
		$userPicUrl=$jsonGetData[$i]->proPic;
}
//Aquiring Data of User Ends

/*
//Aquiring Data of Comics Starts
$sql_selectUser_command="SELECT * FROM  COMICS WHERE authorId =".$userId."";
$jsonTakeData = getUserDataJson($sql_selectUser_command);
$jsonGetData = json_decode($jsonTakeData);
$userRelatedComicsId=array();
for($i=0;$i<sizeof($jsonGetData);$i++)
{
		$userRelatedComicsId[$i]=$jsonGetData[$i]->comicsId;
}
//Aquiring Data of Comics Ends
*/
?>
<body>

<div id="lol">
<!--Main div to Hold the Entire Page Starts-->

<div id="upper" style="background-color:#FAEBD7">
<!-- Upper Div Starts -->

<div id="part_upper1">
<img style="border-radius:40px"src="<?php echo $userPicUrl;?>" alt="Nothing Found Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $userPenName ?>" width="50%" height="100%">
</div>

<div id="part_upper2" >
<center>
<h1 style="color:Grey">Comics Uploaded By You</h1>
</center>
</div>

<div id="part_upper3" align="center" >
<button style="margin:25px;padding:20px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home</button>
<button style="margin:20px;padding:20px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='LogOut.php'">Logout</button>
</div>

<!-- Upper Div Ends -->
</div>

<div id="lower">
<!-- Lower Div Starts -->

<div id="lower_left">
<!-- Lower Left Div Starts -->
<img src="Resource/Boku No Hero Academia.png" alt="Nothing to Show"  width="100%" height="100%">
<!-- Lower Left Div Ends -->
</div>

<div id="lower_middle"  style="overflow-y:scroll;height:80vh;background-color:#FFDEAD">
<!-- Lower Middle Div Starts -->
<?php
$sql_Select_Comics_command="SELECT * FROM COMICS where authorId=".$userId."";
$jsonTakeData1 = getComicsDataJson($sql_Select_Comics_command);
$jsonGetData1 = json_decode($jsonTakeData1);
for($i=0;$i<sizeof($jsonGetData1);$i++)
{
		$cName=$jsonGetData1[$i]->comicsName;
		$cProPic=$jsonGetData1[$i]->comicsProPic;
		$about=$jsonGetData1[$i]->comicsAbout;
		$genre=$jsonGetData1[$i]->genres;
		$cUploadedDate=$jsonGetData1[$i]->uploadedDate;
		
		echo '<div id="container">
			<div id="full" style="background-color:">

			<!--Comics Added by Show Starts-->
			<div id="upper_full" style="background-color:#ffe6cc" >
			<span>Name : '. $cName.'</span><br>
			<span>Author: '. $userPenName.'<span><br>
			<span>Genre: '. $genre.'<span>
			</div>
			<!--Comics Added by Show Ends-->
			
			<!--Comics Picture Show Starts-->
			<div id="middle_left_half" style="background-color:#f1f1da">
			<a href="ReadComics.php?comName='.$cName.'">
			<img style="border-radius:20px;margin:3px;" src="' .$cProPic.'" width="230px" height="190px" title="'.$cName.'">
			</a>
			</div>
			<!--Comics Picture by Show Ends-->

			<!--About Comics Starts-->              
			<div id="middle_right_half" style="background-color:#f1f1da">
			<p>
			'.mb_strimwidth($about,0,450,"....").'
			</p>
			</div>
			<!--About Comics Ends-->
			<div id="lower_full" style="background-color:#ffe6cc" >
			<span>Released Date : '. $cUploadedDate.'</span><br>
			</div>

			</div>
			</div>';
}
if($i==0)
{
	$var="'Add_Comics.php'";
	echo '<center><h2 style="color:#708090">Hey '.$userPenName.' Why Dont you Just Add a Comics/Manga ?</h2><br>
	<button style="margin:25px;padding:20px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='.$var.'">Go to Add</button>
	</center>'; 
}
?>
<!-- Lower Middle Div Ends -->
</div>

<div id="lower_right">
<!-- Lower Right Div Starts -->
<img src="Resource/Bocu No Hero Academia1.png" alt="Nothing to Show"  width="100%" height="100%">
<!-- Lower Right Div Ends -->
</div>


<!-- Lower Div Ends -->
</div>


<!--Main div to Hold the Entire Page Ends-->
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