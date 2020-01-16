<?php
$penNameVal = $_REQUEST['penName'];
$conn=mysqli_connect("localhost","root","","comicallz");
$sql_searchPenName_command="SELECT * FROM USER WHERE penName='".$penNameVal."'";
$data=mysqli_query($conn,$sql_searchPenName_command);
if(mysqli_num_rows($data)>0)
{
	print "<span style=\"color:red;\">PenName Already Exists :( </span>";
}
else 
{
	print "<span style=\"color:green;\">PenName Available :( </span>";
}
?>