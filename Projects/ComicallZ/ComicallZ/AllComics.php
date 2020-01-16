<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Comics</title>
<link rel="stylesheet" href="Design/AllComics_Design.css">
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<!-- Php Code to Load Data from Server Side Starts -->
<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
if($_SESSION['verification']==1)
{
$val=$_SESSION['email'];
$sql_Select_command="SELECT * FROM  USER WHERE email ='".$val."'";
$jsonTakeData = getUserDataJson($sql_Select_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++)
{
		$url=$jsonGetData[$i]->proPic;
		$fname=$jsonGetData[$i]->firstName;
		$pName=$jsonGetData[$i]->penName;
}

?>
<!-- Php Code to Load Data from Server Side Ends -->
<body>

<!-- Neccessary Java Script for This page Starts -->
<script>
function selectGenre(val)
{
	if(val=="Romance")
	{
		<?php$sql_Select_Comics_command="SELECT * FROM COMICS where genres='Romance'";?>
	}
	else if (val=="Action")
	{
		<?php$sql_Select_Comics_command="SELECT * FROM COMICS where genres='Action'";?>
		alert("Nothing to Show");
	}
	else if (val=='Adventure')
	{
		<?php$sql_Select_Comics_command="SELECT * FROM COMICS where genres='Adventure'";?>
	}
	else if (val=='Horror')
	{
		<?php$sql_Select_Comics_command="SELECT * FROM COMICS where genres='Horror'";?>
	}
	else if (val=='Comedy')
	{
		<?php $sql_Select_Comics_command="SELECT * FROM COMICS where genres='Comedy'";?>
	}
}
</script>
<!-- Neccessary Java Script for This page Ends -->

<!-- Parent Containing Div Starts-->
<div id="parent">

<!-- Upper Text Starts -->
<div id="upper" style="background-color:#FAEBD7;">

<div id="part_upper1" >
<img align="left" style="border-radius:40px;" src="<?php echo $url; ?>" alt="Nothing Found Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $fname; ?>" width="100" height="100">
<button align="right" style="margin:20px;padding:20px;" name="homeButton" class="buttons" title="Your Uploaded Comics" onclick="location.href='UserComics.php'"><?php echo $pName; ?></button>
</div>

<!--Searching Comics From Database Starts-->
<div id="part_upper2">
<div class="forSearch">
<span id="data"></span>
<form id="pad" action="ReadComics.php" method="GET" onSubmit="return searchValidation()">
<input id="searchResult" type="text" name="comName" size="100" placeholder="Search...">
<input class="buttons"type="submit" name="search" value="Search"> 
</form>
<div id=result>
</div>
<!-- For Search Script to Load Available Data Starts-->
<script>
$("#searchResult").on("input",function()
	{
		$search=$("#searchResult").val();
		if($search.length>0)
		{
			$.get("DataBaseLoad/ForSearchingComics.php",{search:$search},function($data)
			{
				$("#result").html($data);
			})
		}
	});
function searchValidation ()
{
	
}
</script>
<!-- For Search Script to Load Available Data Ends-->
</div>
</div>
<!--Searching Comics From Database Ends-->


<div id="part_upper3">
<div class="forSelect">
<div class="select_design" style="margin-left:15px">

<select id="selectGenre" onchange="selectGenre(this.value)">
<option>---Select Genres---</option>
	<option value="Comedy">Comedy</option>
	<option value="Romance">Romance</option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
	<option value="Horror">Horror</option>
</select>
</div>
</div>
</div>

<div id="part_upper4">
<div class="forButtons">
<div>
<button style="margin:12px;padding:18px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home </button>
<button style="margin:12px;padding:18px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='LogOut.php'">Logout</button>
</div>
</div>
</div>

</div>
<!-- Upper Text Ends -->

<!-- Lower Comics Container Starts -->
<div id="lower">

<div id="part_lower1" >
<img src="Resource/Haikyuu1.png" alt="Nothing to Show" width="100%" height="100%" >
</div>

<!-- Loading Comics Data Ends -->

<div id="part_lower2" style="overflow-y:scroll;height:85vh;background-color:#FFDEAD" >

<!-- Loading Comics Data  Starts -->
<?php
require("DataBaseLoad/DataBaseLoad_Comics.php");
$sql_Select_Comics_command="SELECT * FROM COMICS";
$jsonTakeData1 = getComicsDataJson($sql_Select_Comics_command);
$jsonGetData1 = json_decode($jsonTakeData1);
for($i=0;$i<sizeof($jsonGetData1);$i++)
{
		$author=$jsonGetData1[$i]->authorId;
		$cName=$jsonGetData1[$i]->comicsName;
		$cProPic=$jsonGetData1[$i]->comicsProPic;
		$about=$jsonGetData1[$i]->comicsAbout;
		$genre=$jsonGetData1[$i]->genres;
		$comicsUploadedDate=$jsonGetData1[$i]->uploadedDate;
		
		/*Matching PenName of Uploader by passing value to DataBaseLoad_User*/
		$sql_Select_UserData_command="SELECT * FROM USER where id='".$author."'";
		$jsonTakeData2 = getUserDataJson($sql_Select_UserData_command);
		$jsonGetData2 = json_decode($jsonTakeData2);
		for($j=0;$j<sizeof($jsonGetData2);$j++)
			{
				$authorName=$jsonGetData2[$j]->penName;
			}			
		
		echo '<div id="container">
			<div id="full" style="background-color:">

			<!--Comics Added by Show Starts-->
			<div id="upper_full" style="background-color:#ffe6cc" >
			<span>Name : '. $cName.'</span><br>
			<span>Author: '. $authorName.'<span><br>
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
			<span>Comics Added : '. $comicsUploadedDate.'</span><br>
			</div>

			</div>
			</div>';
}
?>
</div>

<div id="part_lower3">
<img src="Resource/Haikyuu4.png" alt="Nothing to Show" width="100%" height="100%" >
</div>

</div>
<!-- Lower Comics Container Ends -->

</div>
<!-- Parent Containing Div Ends-->

<?php
}
else 
{
	header('Location:Main.html');
}
?>
</body>
</html>