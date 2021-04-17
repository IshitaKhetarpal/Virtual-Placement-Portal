<!-- HTML for viewing candidates account page-->

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title>My Profile</title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link href="css/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet">
<style>
    .tiltContain{margin-top:0%;} 
    .btnTilt{height: 75px;background:rgba(225,225,225,0.2) ;  color:white; font-family: Comfortaa;}
    .textDarkShadow{ text-shadow: 0px 0px 3px #000,3px 3px 5px #003333; }
</style>

<body onload="logoBeat()" style="font-family: 'Kodchasan', sans-serif;">

<?php
    include 'navBar.php';
    include 'signinEmployerModals.php';
?>

<!-- Main Container -->
<div class="container-fluid" style="background-image:url('img/polaroid.png')">
<?php
	include 'connect.php';
	$s_id = $_SESSION["s_id"];
	
	$sqlE = "select S.name, S.usn, S.branch,SC.email from seeker S, seekercred SC where S.s_id = '$s_id' and S.s_id=SC.sc_id ;";
	$resultE = $conn->query($sqlE);
	if ($resultE->num_rows > 0)
	{
		// output data of each row
		if($rowE = $resultE->fetch_assoc()) 
		{ 
                    $name=  $rowE["name"];
                    $email =  $rowE["email"];
					$usn= $rowE["usn"];
					$branch =$rowE["branch"];
		}
	}
	
	$sql = "select * from seekermarks where sm_id=$s_id";
	$res = $conn->query($sql);
	if ($res->num_rows > 0)
	{
		// output data of each row
		if($row = $res->fetch_assoc()) 
		{ 
            $cgpa= $row["cgpa"];
            $m10 = $row["m10"];
			$m12 = $row["m12"];
			$resume = $row["resume"];
			$mrc10= $row["mrc10"];
			$mrc12= $row["mrc12"];
			$mrcc= $row["mrcc"];
		}
	}
	
	$sqlV = "select * from verified where sv_id='$s_id';";
	$resV = $conn->query($sqlV);
	if ($resV->num_rows > 0)
	{
		// output data of each row
		if($rowV = $resV->fetch_assoc()) 
		{ 
			$status= $rowV['status'];
		}
	}
	
?>
	
<div class="hero" >
<div style="width: 100%; " class="row" >
<center>
<div style=" color: black " class="col-md-6" >                        
<h4 style="margin-top:100px;">Candidate Name:</h4>
<h2><?php echo $name; ?></h2><br><br>
</div>

<div style=" color: black " class="col-md-6" >
<h4 style="margin-top:100px;">USN (Roll Number):</h4>
<h2><?php echo $usn; ?></h2><br><br>
</div>

<div style=" color: black " class="col-md-6" >
<h4 >Branch:</h4>
<h2><?php echo $branch; ?></h2><br><br>
</div>


<div style=" color: black " class="col-md-6" >
<h4 >Email:</h4>
<h2><?php echo $email; ?></h2><br><br>
</div>



<div style=" color: black " class="col-md-6" >
<h4>12th Percentage:</h4>
<?php
	if($m12!=NULL)
	{
?>
		<h2><?php echo $m12; ?></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:20'> Please update your Grade 12 Percentage </h2><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-6" >
<h4>10th Percentage:</h4>
<?php
	if($m10!=NULL)
	{
?>
		<h2><?php echo $m10; ?></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:20'> Please update your Grade 10 Percentage </h2><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-6" >
<h4>CGPA:</h4>
<?php
	if($cgpa!=NULL)
	{
?>
		<h2><?php echo $cgpa; ?></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:20'>Please update your current CGPA</h2><br><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-6" >
<h4 >Status:</h4>
<?php
	if($status== '-1')
	{
		echo "<h2 style='font-weight:bold; font-size:20'>Unverified, Please Update Your Details</h2><br><br>";
	}
	else if($status==0)
	{
		echo "<h2 style='font-weight:bold; font-size:20'> Details Submitted, Waiting for Verification from TPO </h2><br><br>";
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:25'> Details Verified </h2><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-12" >
<h4 style="font-size:25">Resume:</h4>
<?php
	if($resume!=NULL)
	{
?>
		<h2><a href="getting.php?resume=<?= $resume; ?>" target="_blank" style="color:black; font-size:27"> Click here to View</a></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:25'> Please update your Resume </h2><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-12" >
<h4 style="font-size:25">College Marks Card:</h4>
<?php
	if($mrcc!=NULL)
	{
?>
		<h2><a href="getting.php?cmc=<?= $mrcc; ?>" target="_blank" style="color:black; font-size:27"> Click here to View</a></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:25'> Please update your College Marks Card </h2><br><br>";
	}
?>
</div>

<div style=" color: black " class="col-md-12" >
<h4 style="font-size:25">12th Marks Card:</h4>
<?php
	if($mrc12!=NULL)
	{
?>
		<h2><a href="getting.php?mc12=<?= $mrc12; ?>" target="_blank" style="color:black; font-size:27"> Click here to View</a></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:25'> Please update your 12th Grade Marks Card </h2><br><br>";
	}
?>

</div>

<div style=" color: black " class="col-md-12" >
<h4 style="font-size:25">10th Marks Card:</h4>
<?php
	if($mrc10!=NULL)
	{
?>
		<h2><a href="getting.php?mc10=<?= $mrc10; ?>" target="_blank" style="color:black; font-size:27"> Click here to View</a></h2><br><br>
<?php
	
	}
	else
	{
		echo "<h2 style='font-weight:bold; font-size:25'> Please update your 10th Grade Marks Card </h2><br><br>";
	}
?>
</div>

</center>
</div></div>

</div>
 
<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>
<?php include 'footer.php';?>
</body>
</html>