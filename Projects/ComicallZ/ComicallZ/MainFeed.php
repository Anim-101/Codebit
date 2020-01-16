<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ComicallZ- Main Feed</title>
<link rel="stylesheet" href="Design/MainFeed_Design.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!--Main Feed Data Showing Code by Php Starts -->
<?php
session_start();
require("DataBaseLoad/DataBaseLoad_User.php");
if($_SESSION['verification']==1)
{
$val=$_SESSION['email'];
$sql_select_command="SELECT * FROM  USER WHERE email ='".$val."'";
$jsonTakeData = getUserDataJson($sql_select_command);
$jsonTakeData = getUserDataJson($sql_select_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++){
		$fname=$jsonGetData[$i]->firstName;
		$lname=$jsonGetData[$i]->lastName;
		$pname=$jsonGetData[$i]->penName;
		$email=$jsonGetData[$i]->Email;
		$url=$jsonGetData[$i]->proPic;
		$join_date=$jsonGetData[$i]->joinDate;
		$memberSince_date=$jsonGetData[$i]->memberSince;
}

?>
<!--Main Feed Data Showing Code by Php Ends -->
</head>
<body>

<!-- MainFeed Starts -->
<div id="full">
<!-- Upper portion of MainFeed Start -->
<div id="upper" style="background-color:#D3D3D3">


<!-- Upper portion Data Design Starts -->
<div class="forImage">
<a href="MainFeed.php" title="Refresh">
<img src="Resource/Naruto.png" alt="Nothing to Show" width="70" height="60">
</a>
</div>

<div class="forSearch">
<form id="pad">
<input type="text" name="search" placeholder="Search...">
</form>
</div>

<div class="forName">
<h4 style="color:black;padding:12px;">Welcome <?php echo $pname;?></h4>
</div>

<div align="center" class="forButoons">
<button style="margin:8px;padding:10px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home </button> 
<button style="margin:8px;padding:10px;" name="checkButton" class="buttons" title="Check profile?" onclick="location.href='User.php'">Check</button>
<button style="margin:8px;padding:10px;" name="hotButton" class="buttons" title="New Comics Today" onclick="location.href='HotComics.php'">Hot</button>
<button style="margin:8px;padding:10px;" name="addComicsButton" class="buttons" title="Add Comics" onclick="location.href='Add_Comics.php'">Comics</button>
<button style="margin:8px;padding:10px;" name="comicsHubButton" class="buttons" title="Go & Explore Comics" onclick="location.href='AllComics.php'">Comics Hub</button>
<button style="margin:8px;padding:10px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='LogOut.php'">Logout</button>
</div>

<!-- Upper portion Data Design Ends -->
</div>
<!-- Upper portion of MainFeed Ends -->


<!-- Lower portion of MainFeed Start -->

<div id="below">
<!-- Left portion of MainFeed Start -->
<div id="left">


<!-- Adding Image or Getting Image from Database Starts -->
<img style="border-radius:15px;" src="<?php echo $url ?>" alt="Nothing Found Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $fname ?>" width="135" height="150">
<!-- Adding Image or Getting Image from Database Ends -->
<br>
Member Since:<br>
<span style="color:#808080;"> <?php echo $join_date; ?> </span>
<?php
ob_start();
echo date("Y-m-d");
$current_date = ob_get_contents();
ob_end_clean();
$datetime1 = date_create($memberSince_date);
$datetime2 = date_create($current_date);
$diff=date_diff($datetime1,$datetime2);
?>
<br>
Membership:<br>
<p style="color:#808080;"> <?php echo $diff->format("%y Year %m Month %d Day"); ?> </p>
</div>
<!-- Left portion of MainFeed Ends -->


<!-- Middle portion of MainFeed Start -->
<div id="middle" style="background-color:#D3D3D3">
</div>
<!-- Middle portion of MainFeed Ends -->


<!-- Right portion of MainFeed Start -->
<div id="right">
</div>
<!-- Right portion of MainFeed Ends -->
</div>
<!-- Lower portion of MainFeed Ends -->


</div>
<!-- MainFeed Ends -->
<?php
}
else 
{
	header('Location:Main.html');
}
?>
</body>
</html>