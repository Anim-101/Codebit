<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>ComicallZ- Comics</title>
<link rel="stylesheet" href="Design/User_Design.css">
<!-- To Show Temporary Data Links-->
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<!-- Temporary Data Show-->
</head>
<!-- Php Code to Load All information Associated with Current User-->
<?php
require('DataBaseLoad/DataBaseLoad_User.php');
require('DataBaseLoad/DataBaseLoad_Comics.php');
session_start();
if($_SESSION['verification']==1)
{
$val=$_SESSION['email'];
$sql_Select_command="SELECT * FROM  USER WHERE email ='".$val."'";
$jsonTakeData = getUserDataJson($sql_Select_command);
$jsonGetData = json_decode($jsonTakeData);
for($i=0;$i<sizeof($jsonGetData);$i++)
{
		$id=$jsonGetData[$i]->Id;
		$fname=$jsonGetData[$i]->firstName;
		$lname=$jsonGetData[$i]->lastName;
		$penName=$jsonGetData[$i]->penName;
		$email=$jsonGetData[$i]->Email;
		$password=$jsonGetData[$i]->Password;
		$url=$jsonGetData[$i]->proPic;
		$about=$jsonGetData[$i]->About;
		$joinDate=$jsonGetData[$i]->joinDate;
		$memberSinceDate=$jsonGetData[$i]->memberSince;
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
<div id="full">
<!-- Work of Main Div Starts-->

<div id="upper" style="background-color:#2E2E2E">
<!-- Work of Uppper Div Starts-->


<div id="upper_left">
<!-- Work of Uppper_Left Div Starts-->
<a href="User.php">
<img style="border-radius:15px;" src="<?php echo $url ?>" alt="Nothing Found Bro" onerror="this.onerror=null;this.src='Resource/Default_User.png'"  title="<?php echo $fname ?>" width="135" height="130">
</a>
<!-- Work of Uppper_Left Div Ends-->
</div>

<div id="upper_middle">
<h2 style="color:#F0FFFF" align="center">Welcome <?php echo $fname ?> </h2>
<h3 style="color:#F0FFFF"align="center">You are with Us Since <?php echo $joinDate ?> </h3>
<!-- Work of Uppper_Middle Div Starts-->


<!-- Work of Uppper_Middle Div Ends-->
</div>

<div id="upper_right">
<!-- Work of Uppper_Right Div Starts-->
<button style="margin-left:160px;padding:20px;margin-top:40px;" name="homeButton" class="buttons" title="Home!" onclick="location.href='MainFeed.php'">Home </button> 
<button style="margin:20px;padding:20px;" name="logOutButton" class="buttons" title="Good Bye" onclick="location.href='LogOut.php'">Logout</button>
<!-- Work of Uppper_Right Div Ends-->
</div>

<!-- Work of Uppper Div Ends-->
</div>


<div id="lower">
<!-- Work of Uppper Div Starts-->


<div id="lower_left" style="background-color:#2E2E2E">
<!-- Work of Lower_Left Div Starts-->
<button  style="margin:30px;padding:15px;" name="infoButton" class="buttons" title="Stored Inforamtion" onclick="toggle_visibility('lower_container4')">Info</button>
<button  style="margin:30px;padding:15px;" name="addButton" class="buttons" title="Add Inforamtion" onclick="toggle_visibility('lower_container1')">Add</button>
<button  style="margin:30px;padding:15px;" name="updateButton" class="buttons" title="Update Profile" onclick="toggle_visibility('lower_container2')">Update</button>
<button  style="margin:30px;padding:15px;" name="deleteButton" class="buttons" title="Delete" onclick="toggle_visibility('lower_container3')">Delete</button>
<!-- Work of Lower_Left Div Ends-->
</div>


<div id="lower_right" style="background-color:#2E2E2E">
<!-- Work of Lower_Right Div Starts-->

<div id="lower_container1" style="background-color:#2E2E2E">
<!-- Work of Lower_Container1 Div Starts-->
<script>
function readURL(input)
{
	if(input.files && input.files[0])
	{
		var reader = new FileReader();
		reader.onload = function(e){
		$('#showImage')
		.attr('src',e.target.result)
		.width(150)
		.height(200);
		};
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
<center>
<form action="UserPhotoUpload.php" method="post" enctype="multipart/form-data"" name="uploadUserPhotoForm">
<p style="color:#F0FFFF">Upload/Change Pictures:<br>
<input class="buttons" type="file" name="proPicToUpload" id="proPicToUpload"  onChange="readURL(this);" accept="image/*"><br><br>
<img id="showImage" src="#" alt="yourImage" title="It Looks Nice <?php echo $fname; ?>" /><br><br>
<input class="buttons" type="submit" onclick="return validate();" value="Upload" name="submitFile">
</form>
</center>
<!-- Work of Lower_Container1 Div Ends-->
</div>

<div id="lower_container2" style="background-color:#2E2E2E">
<!-- Work of Lower_Container2 Div Starts-->
<center>
<form action="UpdateUser.php" method="post"><pre><h3>
First Name  	: <input type="text" name="updateFirstName" value="<?php echo $fname;?>"><h3>
<h3>Last Name 	: <input type="text" name="updateLastName" value="<?php echo $lname;?>"><h3>
<h3>Pen Name 	: <input type="text" name="updatePenName" value="<?php echo $penName;?>"><h3>
<h3>Email 		: <input type="text" name="updateEmail" value="<?php echo $email;?>"><h3>
<h3>Password 	: <input type="text" name="updatePassword" value="<?php echo $password;?>"><h3>
<h3>About 		: <input type="text" name="updateAbout" value="<?php echo $about;?>"><h3><br>
<input class="buttons" title="change" type="submit" value="Update">
<pre>
</form>
</center>
<!-- Work of Lower_Container2 Div Ends-->
</div>

<div id="lower_container3" style="background-color:#2E2E2E">
<!-- Work of Lower_Container3 Div Starts-->
<center>
<h1 style="color:#428bca;">You Sure About Leaving This community<h2><br><br>
<button  style="margin:30px;padding:15px;" name="leaveButton" class="buttons" title="Good Bye <?php echo $fname ?>!" onclick="location.href='DeleteUser.php'">Leave</button>
<button  style="margin:30px;padding:15px;" name="stayButton" class="buttons" title="Do It <?php echo $fname ?>!" onclick="location.href='User.php'">Stay</button>
</center>
<!-- Work of Lower_Container3 Div Ends-->
</div>

<!--Work of Lower Contianer 4 To show Information Starts-->
<div id="lower_container4">
<pre style="color:white">
ComicallZ ID 		: <?php echo $id; ?><br></pre><pre style="color:white">
First Name 		: <?php echo $fname; ?><br>
Last Name 		: <?php echo $lname; ?><br>
Pen Name 		: <?php echo $penName; ?><br>
Email 			: <?php echo $email; ?><br>
password		: <?php echo $password?> <br></pre><pre style="color:white">
Uploaded Comics 	: <?php
$sql_SelectComics_command="SELECT * FROM  COMICS WHERE authorId =".$id."";
$jsonTakeData1 = getComicsDataJson($sql_SelectComics_command);
$jsonGetData1 = json_decode($jsonTakeData1);
for($i=0;$i<sizeof($jsonGetData1);$i++)
{
	$comName=$jsonGetData1[$i]->comicsName;
	if ($i==0) 
	{
		echo $comName;
	}
	else 
	{
		echo ", ";
		echo $comName;
		
	}
}
if($i==0)
{
	echo "None";
}
?><br>
Join  Date 		: <?php echo $joinDate ?><br>
Member For 		: <?php
ob_start();
echo date("Y-m-d");
$current_date = ob_get_contents();
ob_end_clean();
$datetime1 = date_create($memberSinceDate);
$datetime2 = date_create($current_date);
$diff=date_diff($datetime1,$datetime2);
echo $diff->format("%y Year %m Month %d Day");
?><br>
</pre>
</div>
<!-- Work of Lower Container 4 to Show Information Ends-->

<!-- Work of Lower_Right Div Ends-->
</div>

<!-- Work of Uppper Div Ends-->
</div>


<!-- Work of Main Div Ends-->
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
