<?php
$conn=mysqli_connect("localhost","root","","comicallz");
$sql_search_command="SELECT comicsName from COMICS WHERE comicsName LIKE '".$_GET['search']."'";
$result =mysqli_query($conn,$sql_search_command) or die (mysqli_error($conn));
if (sizeof($result)==0)
{
	echo "Not Found in Server";
}
else 
{
	while($row = mysqli_fetch_assoc($result))
	{
		echo "$row[comicsName]<br>";
	}
}

?>