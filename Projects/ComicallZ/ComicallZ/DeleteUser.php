<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="Design/DeleteUser_Design.css">
</head>
<?php
session_start();
if($_SESSION['verification']==1)
{
$emailToDelete=$_SESSION['email'];
?>
<body style="background-color:#1E1C1C">
<center>
<h1 style="color:white">Gathering Informating Wait !!</h1>
<script>
function sleep (ms)
{
	return new Promise (resolve=>setTimout(resolve,ms));
}
async function hula ()
{
	await.sleep(5000);
}
hula();
</script>
<?php
/*
sleep(10);
*/
?>
<h3 style="color:white">Want to Delete All Informations/Comics Too ? </h3>
<button  style="margin:30px;padding:15px;" name="yesButton" class="buttons" title="Delete Entire Data Including Comics"  onclick="location.href='DeleteEntireUserData.php'">Yes</button>
<button  style="margin:30px;padding:15px;" name="noButton" class="buttons" title="Delete Only User Profile"  onclick="location.href='DeleteUserData.php'">No</button>
<button  style="margin:30px;padding:15px;" name="notDeleteButton" class="buttons" title="Go Back->Don't Delete"  onclick="location.href='MainFeed.php'">Don't</button><br><br>
<img src="Resource/The boy and The Beast.jpg" alt="Nothing to Show Bro" title="We Will be Happy if you don't leave !">
</center>
<?php
}
else 
{
	header('Location:Main.html');
}
?>
</body>
</html>
