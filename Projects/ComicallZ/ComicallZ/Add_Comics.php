<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Add Comics</title>
<link rel="stylesheet" href="Design/AddComics_Design.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
require("DataBaseLoad/DataBaseLoad_Comics.php");
if($_SESSION['verification']==1)
{
$val=$_SESSION['email'];
$sql_select_command="SELECT * FROM  USER WHERE email ='".$val."'";
$jsonTakeData = getUserDataJson($sql_select_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++){
		$userId=$jsonGetData[$i]->Id;
		$fname=$jsonGetData[$i]->firstName;
		$lname=$jsonGetData[$i]->lastName;
		$pname=$jsonGetData[$i]->penName;
		$email=$jsonGetData[$i]->Email;
		$url=$jsonGetData[$i]->proPic;
		$join_date=$jsonGetData[$i]->joinDate;
		$memberSince_date=$jsonGetData[$i]->memberSince;
}

?>
<body>
<script type="text/javascript">
function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
}
</script>
<!-- Parent Div Starts -->
<div id="full1">

<!--Upper Container Div Starts-->
<div id="upper" style="background-color:#E6E6FA">

<!-- Upeer Profile Pic Continaer Starts-->
<div id="upper_pic_container">
<img style="border-radius:15px;" src="<?php echo $url ?>" alt="Nothing Found Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $fname; ?>" width="130" height="100">
</div>
<!-- Upeer Profile Pic Continaer Ends-->

<!--Upper Buttons Continaer Starts-->
<div id="upper_button_container">
<div align="right">
<button style="margin:25px;padding:15px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home </button> 
<button style="margin:25px;padding:15px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='LogOut.php'">Logout</button>
</div>

</div>
<!--Upper Buttons Continaer Ends-->

<!--Upper Container Div Ends-->
</div>


<!-- Lower Continer Starts-->
<div id="lower">

<!-- Lower Button Container Starts-->
<div id="lower_button_container"  style="background-color:#E6E6FA">
<button id="new" style="margin:25px;padding:15px;" name="newComicsButton" class="buttons" title="New Comics" onclick="toggle_visibility('lower_form_container1')" >New</button> 
<button id="add" style="margin:25px;padding:15px;" name="addComicsButton" class="buttons" title="Add Comics" onclick="toggle_visibility('lower_form_container2')" >Add</button> 
<button id="modify" style="margin:25px;padding:15px;" name="modifyComicsButton" class="buttons" title="Modify Existing Comics" onclick="toggle_visibility('lower_form_container3')">Modify</button>
<button id="removeComics" style="margin:25px;padding:15px;" name="removeComicsButton" class="buttons" title="Remove Uploaded Comics" onclick="toggle_visibility('lower_form_container4')">Remove</button> 
<button id="removeChapters" style="margin:25px;padding:15px;" name="removeChaptersButton" class="buttons" title="Remove Uploaded Comic's Chapters" onclick="toggle_visibility('lower_form_container5')">RemChapters</button>
</div>
<!-- Lower Button Container Ends-->

<!-- Lower Form Container Starts-->
<div id="lower_form_container" style="background-color:#E6E6FA">

<!-- Form Validation for Adding New Comics in Database Starts -->
<script>

</script>
<!-- Form Validation for Adding New Comics in Database Ends -->

<!-- New Form Container Starts-->
<div id="lower_form_container1" style="background-color:#E6E6FA;">
<center>
<form name="Log" action="NewComics_Upload.php" method="post" enctype="multipart/form-data">
<br>
Comics Name :<br>
<span id="comicsNameLoc"></span><br>
<input type="text" name="comicsName" id="comicsName"><br>
Comics About :<br><br>
<span id="comicsAboutLoc"></span><br>
<textarea name="comicsAbout" id="comicsAbout" rows="4" cols="40"></textarea><br>
Select Comics Picture :<br><br>
<input class="buttons" type="file" name="picToUpload" id="picToUpload" accept="image/*"><br>
Select Images to Upload :<br><br>
<span id="filesToUploadLoc"></span><br>
<input class="buttons" type="file"  name="filesToUpload[]" multiple="multiple" id="fileToUpload" accept="image/*"><br>
Select Genre :<br>
<div class="select_design">
<select name="selectGenre">
<option>---Select Genres---</option>
	<option value="Comedy">Comedy</option>
	<option value="Romance">Romance</option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
	<option value="Horror">Horror</option>
</select>
</div><br>
<input class="buttons" type="submit" onclick="return validate();" value="Upload" name="submitFile">
</form>
</center>

</div>
<!-- New Form Container Ends-->


<!-- Add Form Container Starts-->
<div id="lower_form_container2" style="background-color:#E6E6FA;">
<center>
<?php
$sql_select_command22="SELECT * FROM  COMICS WHERE authorId =".$userId."";
$jsonTakeData22 = getUserDataJson($sql_select_command22);
$jsonGetData22 = json_decode($jsonTakeData22);
$val22=0;
for($i=0;$i<sizeof($jsonGetData22);$i++){
		$comName=$jsonGetData22[$i]->comicsName;
		$comCount=$jsonGetData22[$i]->comicsCount;
		if($val22==0)
		{
			echo	' <select name="uploadChapter" onChange="chapterUpdate(this)">
					<option>Pick Comics to add Chapters</option>';
			$val22=1;
		}
		if($comCount<9)
		{
			echo '<option value="'.$comName." Chapter 0".++$comCount.'">'.$comName.'</option>';
			$vall22=1;
		}
		else 
		{
			echo '<option value="'.$comName." Chapter ".++$comCount.'">'.$comName.'</option>';
			$val22=1;
		}
}
if($i==0)
{
	$var22="'Add_Comics.php'";
	echo '<center><h2 style="color:#708090">Hey '.$pname.' Why Dont you Just Add a Comics/Manga ?</h2><br>
	<button style="margin:25px;padding:20px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='.$var22.'">Go to Add</button>
	</center>';
}
?>
</select><br><br>
<form  name="chapterLog" action="NewChapterUpload.php" method="post" enctype="multipart/form-data" onsubmit="return chapterValidation()">
<span id="textNameLoc"></span><br>
<input type="text" name="chapterUploadComicsName" value="" id="canvas" readonly><br><br>
Select Chapter Images to Upload :<br><br>
<input class="buttons" type="file"  name="chapterToUpload[]" multiple="multiple" id="cahpterToUpload" accept="image/*"><br><br><br>
<input class="buttons" type="submit" name="submit" value="Upload">
</form>
</div>
</center>
<script>
function chapterUpdate(yes)
{
	document.getElementById("canvas").value=yes.value;
}
function chapterValidation()
{
	var textName=document.chapterLog.chapterUploadComicsName.value;
	var status=false
	if(textName.length<1)
	{
		document.getElementById("textNameLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Upload/Pic Your Comics and Then You will be able to Upload Chapters';
		status=false;
	}
	else 
	{
		document.getElementById("textNameLoc").innerHTML=
		'<img src="Resource/checked.png" width="15" height="15"/>Alright';
		status=true;
	}
	return status;
}
</script>
<!-- Add Form Container Ends-->


<!-- Modify Form Container Starts-->
<div id="lower_form_container3" style="background-color:#E6E6FA;">
<?php
$sql_SelectComics_command="SELECT * FROM COMICS where authorId=".$userId."";
$jsonTakeData2 = getComicsDataJson($sql_SelectComics_command);
$jsonGetData2 = json_decode($jsonTakeData2);
$val=1;
?>
<center>
<div class="select_design2">
<select name="selectName" id="selectName">
<option>Pic A Comics To Update</option>
<?php
for($i=0;$i<sizeof($jsonGetData2);$i++)
{
		$coName=$jsonGetData2[$i]->comicsName;
		echo '<option value='.$coName.'>'.$coName.'</option>';
}
?>
</select>
</div>
</center>
<!--Modify Form Container Ends -->
</div>

<!-- Remove Form Container Starts-->
<div id="lower_form_container4" style="overflow-y:scroll;height:85vh;background-color:#E6E6FA;" >
<?php
$sql_Select_Comics_command="SELECT * FROM COMICS where authorId=".$userId."";
$jsonTakeData1 = getComicsDataJson($sql_Select_Comics_command);
$jsonGetData1 = json_decode($jsonTakeData1);
$val=1;
for($j=0;$j<sizeof($jsonGetData1);$j++)
{
	
		$cName=$jsonGetData1[$j]->comicsName;
		$cProPic=$jsonGetData1[$j]->comicsProPic;
		$about=$jsonGetData1[$j]->comicsAbout;
		$genre=$jsonGetData1[$j]->genres;
		
		if($val==1)
		{
			echo '<center><h4 style="color:black">Comics List</h4></center>';
		}
		$val=0;
		echo '<div id="container" style="margin-left:470px;margin-top:30px;">
			<div id="full2" style="padding:100">

			<!--Comics Added by Show Starts-->
			<div id="upper_full" style="background-color:#E6E6FA;" >
			<span >Name : '. $cName.'</span><br>
			<span >Genre: '. $genre.'<span>
			</div>
			<!--Comics Added by Show Ends-->
			
			<!--Comics Picture Show Starts-->
			<div id="middle" style="background-color:#E6E6FA;">
			<a href="DeleteComics.php?comName='.$cName.'">
			<img src="' .$cProPic.'" width="250px" height="210px" title="Delete '.$cName.'">
			</a>
			</div>
			<!--Comics Picture by Show Ends-->
			
			</div>
			</div>';
			
}
if($j==0)
{
	$var="'Add_Comics.php'";
	echo '<center><h2 style="color:#708090">Hey '.$pname.' Why Dont you Just Add a Comics/Manga ?</h2><br>
	<button style="margin:25px;padding:20px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='.$var.'">Go to Add</button>
	</center>'; 

}
?>
</div>
<!-- Remove Form Container Ends-->

<!--Remove Chapter Container Starts-->
<div id="lower_form_container5" style="overflow-y:scroll;height:85vh;background-color:#E6E6FA;">
<?php
$sql_SelectComics_command3="SELECT * FROM COMICS where authorId=".$userId."";
$jsonTakeData3 = getComicsDataJson($sql_SelectComics_command3);
$jsonGetData3 = json_decode($jsonTakeData3);
$val=1;
?>
<center>
<div class="select_design2">
<select name="selectComicsName" id="selectComicsNameName" onChange="chapterDelete(this)">
<option>Pic A Comics</option>
<?php
for($i=0;$i<sizeof($jsonGetData2);$i++)
{
		$comiName=$jsonGetData3[$i]->comicsName;
		echo '<option value="'.$comiName.'">'.$comiName.'</option>';
}
?>
</select>
</div>
<form name="chaptersToDelete"action="RemoveChaptersSelect.php" method="post" onsubmit="return deleteChapterValidation()"><br><br>
<span id="chapterDeleteLoc"></span><br>
<input type="text" name="chapterDeleteName" value="" id="deleteChapterComicsName" readonly><br><br><br>
<input class="buttons" type="submit" value="Go">
</form>
<!--Taking Selected Value  Starts-->
<script>
function chapterDelete(getter)
{
	document.getElementById("deleteChapterComicsName").value=getter.value;
}
function deleteChapterValidation()
{
	var x=document.chaptersToDelete.chapterDeleteName.value;
	var status=false;
	if(x.length<1)
	{
		document.getElementById("chapterDeleteLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Upload/Pic Your Comics and Then You will be able to Upload Chapters';
		status=false;
	}
	else
	{
		document.getElementById("chapterDeleteLoc").innerHTML=
		'<img src="Resource/checked.png" width="15" height="15"/>Alright';
		status=true;
	}
	return status;
}
</script>
<!--Taking Selected Value Ends-->
</center>
</div>
<!--Remove Chapter Container Ends-->

<!-- Lower Form Container Starts-->
</div>

<!-- Lower Continer Ends-->
</div>

<!-- Parent Div Ends -->
</div>
<?php
}
else
{
	header('Location:Main.html');
}
?>
</body>
<html>