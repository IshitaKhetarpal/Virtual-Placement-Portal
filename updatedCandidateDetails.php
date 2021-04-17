<?php

// Create connection
	include 'connect.php';
	require 'start.php';
	$r_flag=$c_flag=0;
	$id=$cgpa=$m10=$m12=$resume=$MC10=$MC12=$CMC=$msg="";
	$sql="Select * from seekermarks where sm_id=$s_id;";
	$res=$conn->query($sql);
	if($res->num_rows > 0)
    {	
		if($row=$res->fetch_assoc())
		{
			$id=$row['s_id'];
			$cgpa=$row['cgpa'];
			$m10=$row['m10'];
			$m12=$row['m12'];
			$resume=$row['resume'];
			$MC10=$row['mrc10'];
			$MC12=$row['mrc12'];
			$CMC=$row['mrcc'];
		}
	}
	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        if(isset($_POST['submitDetails']))
        {	            
            $cgpa= $_POST['cgpa'];
			
			if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) 
			{	
				$Fname= basename($_FILES["resume"]["name"]);
				$uploadOk = 1;
				$fileType = strtolower(pathinfo($Fname,PATHINFO_EXTENSION));
				$temp_name=$_FILES["resume"]["tmp_name"];
				// Check file size
				if ($_FILES["resume"]["size"] > 5000000) 
				{
					$msg.= " The file ". $fileName." is too large<br>";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($fileType != "txt" && $fileType != "doc" && $fileType != "docx" && $fileType != "pdf" )
				{
					$msg.= " Only txt, doc, docx & pdf files are allowed -->".$fileName."<br>";
					$uploadOk = 0;
				}
					
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 1)
				{				
					try
					{
						$result = $s3Client->putObject([
						'Bucket' => $config['s3']['bucket'],
						'Key' => 'resume/'.$Fname,
						'Body' => fopen($temp_name,'rb'),
						'ACL'=>'public-read'							
						]);
						$resume=$Fname;
						$r_flag=1;
					}
					catch(Exception $e)
					{
						$msg.= "Sorry, the resume could not be uploaded<br>";
					}
				}
				else 
				{	
					$msg.=  "Sorry Resume not uploaded<br>";
				}
			}
			if (isset($_FILES["CMC"]) && $_FILES["CMC"]["error"] == 0) 
			{
				$Fname= basename($_FILES["CMC"]["name"]);
				$uploadOk = 1;
				$fileType = strtolower(pathinfo($Fname,PATHINFO_EXTENSION));
				$temp_name=$_FILES["CMC"]["tmp_name"];
				// Check file size
				if ($_FILES["CMC"]["size"] > 5000000) 
				{
					$msg.= " The file ". $fileName." is too large<br>";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($fileType != "txt" && $fileType != "doc" && $fileType != "docx" && $fileType != "pdf" )
				{
					$msg.= " Only txt, doc, docx & pdf files are allowed <br>";
					$uploadOk = 0;
				}
					
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 1)
				{				
					try
					{
						$result = $s3Client->putObject([
						'Bucket' => $config['s3']['bucket'],
						'Key' => 'CMC/'.$Fname,
						'Body' => fopen($temp_name,'rb'),
						'ACL'=>'public-read'							
						]);
						$CMC=$Fname;
						$c_flag=1;
					}
					catch(Exception $e)
					{
						$msg.= "Sorry the College Marks Card could not be uploaded<br>";
					}
				}
				else 
				{	
					$msg.=  "Sorry College Marks Cardvnot uploaded<br>";	
				}
			}
			
			if($r_flag==1 and $c_flag==0)
			{	
				$sql1="UPDATE seekermarks set resume='$resume' where sm_id='$s_id';";
				if ($conn->query($sql1) === TRUE ) 
				{
					$msg.= " Your resume has been successfully updated";
				}
				else 
				{
					$msg.= " An error occurred, please try again later<br>";
				}
			}
			else if($r_flag==0 and $c_flag==0)
			{
			}
			else
			{	
				$sql2="UPDATE seekermarks set cgpa='$cgpa', resume='$resume', mrcc='$CMC' where sm_id='$s_id';";
				$sql3="update verified set status=0 where sv_id=$s_id;";
				if ($conn->query($sql2) === TRUE and $conn->query($sql3) == TRUE) 
				{
					$msg.= " Your details have been successfully updated and sent for verification";
				}
				else 
				{
					$msg.= " An error occurred, please try again later<br>";
				}
			}
		}
	}				
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Details Update </title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link href="css/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet">

<body onload="logoBeat()" style="font-family: 'Kodchasan', sans-serif;">

<?php include 'navBar.php'; ?>

<!-- Main Container -->
<div class="container-fluid" style="background-color:#3bb3e0;">

	
<div class="hero" >
<div class="container contact-form" style=" background-image: url('img/bgbg.png'); box-shadow: 0px 0px 25px #1e1e1e;">
<div class="contact-image" >
<img src="img/rocket_contact.png"style=" background-image: url('img/bgbg.png'); box-shadow: 0px 0px 25px #1e1e1e;" alt="rocket_contact"/>
</div>
<form method="post" action="" enctype="multipart/form-data">
<center>
<h2 style='margin-top:-100; color:white; font-weight:bold'>Update Your Details</h2>
<h5 style='margin-bottom:50; color:white'>Please ensure all file names are "USN_FILENAME"</h5>
</center>
<div class="row">
<div><?php echo $msg;?></div>
<input type='hidden' value="<?php echo $s_id;?>" name='s_id'/>

<div class="col-md-6">
<div class="form-group">
<label for="resume">Resume:</label>                            
<input type="file" name="resume" class="form-control"  />
<br>
<input type='text' value="<?php echo $resume;?>" readonly class='form-control' placeholder='Resume not uploaded'>
</div>

<div class="form-group">
<label for="CMC">College Marks Card</label>
<input type="file" name="CMC" class="form-control" />
<br>
<input type='text' value="<?php echo $CMC;?>" readonly class='form-control' placeholder='College marks card not uploaded'>
</div>

<div class="form-group">
<label for="10MC">10th Marks Card</label>
<input type="file" name="10MC" class="form-control" id="10MC" disabled />
<br>
<input type='text' value="<?php echo $MC10;?>" readonly class='form-control'>
</div>

<div class="form-group">
<label for="12MC">12th Marks Card</label>
<input type="file" name="12MC" class="form-control" id="12MC" disabled />
<br>
<input type='text' value="<?php echo $MC12;?>" readonly class='form-control'>
</div>


</div>
<div class="col-md-6">
<div class="form-group">
<label for="cgpa">CGPA</label>
<input type="text" name="cgpa" class="form-control" placeholder="CGPA" value="<?php echo $cgpa;?>" required pattern="\d\d.\d\d"/>
</div>

<div class="form-group">
<label for="industry">10th Grade Percentage </label>
<input type='text' name="m10" id="m10" class="form-control"  value="<?php echo $m10;?>"  disabled />
</div>

<div class="form-group">
<label for="industry">12th Grade Percentage </label>
<input type='text' name="m12" id="m12" class="form-control"  value="<?php echo $m12;?>"  disabled />
<br><br>
</div>

<div class="form-group">
<button type="submit" name="submitDetails" class="btnContact pull-right" >Submit Details</button>

</div></div></div>
</form>
</div></div></div>

<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>

<?php include 'footer.php';?>
</body>
</html>
