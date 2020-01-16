<?php
function getPostDataJson ($sql)
{
	$conn = mysqli_connect("localhost","root","","comicallz");
	$result =mysqli_query($conn,$sql) or die (mysqli_error());
	$arrVal = array();
	while($row = mysqli_fetch_assoc($result))
	{
		$arrVal[]=$row;
	}
	return json_encode($arrVal);
	mysqli_close($conn);
}
?>