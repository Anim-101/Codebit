<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>ComicallZ- Sign Up</title>
<link rel="stylesheet" href="Design/SignUp_Design.css">
</head>
<body>
<!-- First Div to hold side Image Start-->
<div id="_div1">
<a href="SignUp.php">
<img src ="Resource/Studio_Ghibli_Cats.jpg" title="Refresh Sign Up" alt="Nothing to Load">
</a>
</div>
<!-- First Div to hold side Image End-->
<div id="_div2">
<!-- Second Div to hold SignUp Form Start-->
<center>
<!-- Div To Load Form with Design Start-->
<div class="contianer">

<!-- Script to check wheter filed are empty or not Start -->
<script type="text/javascript">
function formValidation ()
{
	var fName =document.Log.firstName.value;
	var lName =document.Log.lastName.value;
	var pName =document.Log.penName.value;
	var email =document.Log.email.value;
	var password=document.Log.password.value;
	var confirmPassword=document.Log.confirmPassword.value;
	var status=false;
	//First Name Length must be Greater than Blank(1) check
	if(fName.length<1)
	{
		document.getElementById("firstNameLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>First Name can\'t be blank';
		status=false;
	}
	else 
	{
		document.getElementById("firstNameLoc").innerHTML=
		'<img src="Resource/checked.png" width="15" height="15"/>Alright';
		status=true;
	}
	//Last Name Length must be Greater than Blank(1) check
	if(lName.length<1)
	{
		document.getElementById("lastNameLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Last Name can\'t be blank';
		status=false;
	}
	else 
	{
		document.getElementById("lastNameLoc").innerHTML=
		'<img src="Resource/checked.png" width="15" height="15"/>Alright';
		status=true;
	}
	//Password Length Blannk or not Check
	if(password.length<1)
	{
		document.getElementById("passwordLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Password Can\'t be Blanked';
		status=false;
	}
	else 
	{
		if(password.length<8)
			{
				document.getElementById("passwordLoc").innerHTML=
				'<img src="Resource/unchecked.gif"/>Password Must be 8 char Long';
				status=false;
			}
		else 
			{
				document.getElementById("passwordLoc").innerHTML=
				'<img src="Resource/checked.png" width="15" height="15"/>Alright';
				status=true;
			}
	}	
	//Pen Name Length must be Greater than Blank(1) check
	if(pName.length<1)
	{
		document.getElementById("penNameLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Pen Name Can\'t be Blanked';
		status=false;
	}
	else 
	{
		document.getElementById("penNameLoc").innerHTML=
		'<img src="Resource/checked.png" width="15" height="15" />Alright';
		status=true;
	}
	//Email Length must be Greater than Blank(1) check
	if(email.length<1)
	{
		document.getElementById("emailLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Email Can\'t be Blanked';
		status=false;
	}
	else 
	{
		var atPosition=email.indexOf("@");
		var dotPosition=email.indexOf(".");
		if (atPosition<1 || dotPosition<atPosition+2 || dotPosition+2>=email.length)
		{
			document.getElementById("emailLoc").innerHTML=
			'<img src="Resource/unchecked.gif"/>Invalid Email Format';
			status=false;
		}
		else 
		{
			document.getElementById("emailLoc").innerHTML=
			'<img src="Resource/checked.png" width="15" height="15" />Alright';
			status=true;
		}
	}
	//confirmPassword Length must be Greater than Blank(1) check
	if(confirmPassword.length<1)
	{
		document.getElementById("confirmPasswordLoc").innerHTML=
		'<img src="Resource/unchecked.gif"/>Confirm Password Can\'t be Blanked';
		status=false;
	}
	else 
	{
		if(confirmPassword!=password)
		{
			document.getElementById("confirmPasswordLoc").innerHTML=
			'<img src="Resource/unchecked.gif"/>Password doesn\t Match';
			status=false;
		}
		else 
		{
			document.getElementById("confirmPasswordLoc").innerHTML=
			'<img src="Resource/checked.png" width="15" height="15"/>Alright';
			status=true;
		}
	}
	return status;	
}

</script>
<!-- Script to check wheter filed are empty or not End -->

<form name="Log" id="log"  action="SignUpInsert.php" method="post" onsubmit="return formValidation();">
<label><b>First Name</b></label><br>
<span id="firstNameLoc"></span><br>
<input type="text" placeholder="Enter your Last Name"  name="firstName"><br>
<label><b>Last Name</b></label><br>
<span id="lastNameLoc"></span><br>
<input type="text" placeholder="Enter your Last Name" name="lastName"><br>
<label><b>Pen Name</b></label><br>
<span id="penNameLoc"></span><br>
<input type="text" placeholder="Enter your Unique Pen Name" name="penName" id="penNameId"><br>
<label><b>Email</b></label><br>
<span id="emailLoc"></span><br>
<input type="text" placeholder="Enter your Email" name="email"><br>
<label><b>Password</b></label><br>
<span id="passwordLoc"></span><br>
<input type="password" placeholder="Enter your Password" name="password"><br>
<label><b>Confirm Password</b></label><br>
<span id="confirmPasswordLoc"></span><br>
<input type="password" placeholder="Enter your Password Again" name="confirmPassword"><br>
<input type="submit" title="Done?" value="Sign Up"><br>
<!-- Div To Load Form with Design End--->

<!-- Cancel Button Div Start -->
<div class ="contianer">
<button type="button" class="cancelBtn" title="Go Back" onclick="location.href='Main.html'">Cancel</button>
</div>
<!-- Cancel Button Div End -->
</form>
</div>
</center>
<!-- Second Div to hold SignUp Form End-->
</body>
</html>