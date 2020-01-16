<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Read Comics</title>
<link rel="stylesheet" href="Design/ReadComics_Design.css">
</head>
<body style="backgroundColor:grey">
<?php
session_start();
if($_SESSION['verification']==1)
{
$var1="'MainFeed.php'";
$var2="'LogOut.php'";
$_SESSION['comicsName']=$_REQUEST['chapterDeleteName'];
$target_dir="Profile/Comics/".$_REQUEST['chapterDeleteName']."/Comics/";
echo '<center>';
echo '<button style="margin:25px;padding:15px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='.$var1.'">Home </button>';
echo '<button style="margin:25px;padding:15px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='.$var2.'">Logout</button>';
echo '<br><br>';
echo '<select name="fileRead" onChange="chapterDelete(this)">';
if(is_dir($target_dir))
			{
				$files=glob($target_dir.'*',GLOB_MARK);
				foreach($files as $file)
				{
					$fileName = explode("/",$file);
					$finalFileName = explode('\\',$fileName[4]);
					echo '<option value="'.$finalFileName[0].'">'.$finalFileName[0].'</option>';

				}
			}
echo '</select><br><br>';
?>
<form name="Log" action="RemoveChapters.php" method="post" onsubmit="return deleteChapterValidation()">
<h4 style="color:red">Your Selected Chapter to Be Deleted<h4>
<span id="chapterDeleteLoc"></span><br>
<input type="text" name="chapterDeleteName1" value="" id="deleteChapterName" size="35" readonly><br><br><br>
<input class="buttons" type="submit" value="Go"><br><br>
</form>
<img src="Resource/luffy.jpg" alt="Pic one to Delete" height="600">
</center>
<!--Taking Selected Value  Starts-->
<script>
function chapterDelete(getter)
{
	document.getElementById("deleteChapterName").value=getter.value;
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
<?php 
}
else 
{
	header('location:Main.html');
}
?>
<body>
</html>