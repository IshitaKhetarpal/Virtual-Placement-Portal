<?php

// Create connection
   
	include 'connect.php';
	require 'start.php';
	//$s_id=$_SESSION["s_id"];
	
	$id=$cgpa=$m10=$m12=$resume=$MC10=$MC12=$CMC=$msg="";
	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        	
        if(isset($_POST['submitDetails']))
        {	            
            $cgpa= $_POST['cgpa'];
            $m10=$_POST['m10'];
			$m12=$_POST['m12'];
			
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
			if (isset($_FILES["10MC"]) && $_FILES["10MC"]["error"] == 0) 
			{
				$Fname= basename($_FILES["10MC"]["name"]);
				$uploadOk = 1;
				$fileType = strtolower(pathinfo($Fname,PATHINFO_EXTENSION));
				$temp_name=$_FILES["10MC"]["tmp_name"];
				// Check file size
				if ($_FILES["10MC"]["size"] > 5000000) 
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
						'Key' => 'MC10/'.$Fname,
						'Body' => fopen($temp_name,'rb'),
						'ACL'=>'public-read'							
						]);
						$MC10=$Fname;
					}
					catch(Exception $e)
					{
						$msg.="Sorry the 10th Grade Marks Card could not be uploaded<br>";
					}
				}
				else 
				{	
					$msg.=  "Sorry 10th Grade Marks Card not uploaded<br>";
						
				}
			}
			if (isset($_FILES["12MC"]) && $_FILES["12MC"]["error"] == 0) 
			{
				$Fname= basename($_FILES["12MC"]["name"]);
				$uploadOk = 1;
				$fileType = strtolower(pathinfo($Fname,PATHINFO_EXTENSION));
				$temp_name=$_FILES["12MC"]["tmp_name"];
				// Check file size
				if ($_FILES["12MC"]["size"] > 5000000) 
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
						'Key' => 'MC12/'.$Fname,
						'Body' => fopen($temp_name,'rb'),
						'ACL'=>'public-read'							
						]);
						$MC12=$Fname;
					}
					catch(Exception $e)
					{
						$msg.="Sorry the 12th Grade Marks Card could not be uploaded<br>";
					}
				}
				else 
				{	
					$msg.=  "Sorry 12th Grade Marks Card not uploaded<br>";
						
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
					}
					catch(Exception $e)
					{
						$msg.= "Sorry the College Marks Card could not be uploaded<br>";
					}
				}
				else 
				{	
					$msg.=  "Sorry College Marks Card not uploaded<br>";	
				}
			}
		
			$sql="Insert into seekermarks(sm_id,cgpa,m10,m12,resume,mrc10,mrc12,mrcc) VALUES ('$s_id','$cgpa','$m10','$m12','$resume','$MC10','$MC12','$CMC');";
			$sql12="UPDATE verified set `status`=0 where sv_id=$s_id;";
			if ($conn->query($sql) === TRUE and $conn->query($sql12) == TRUE ) 
			{
				$msg.= " Your details have been successfully updated and sent for verification";
			}
			else 
			{
				$msg.= "There was an error updating your details, please try again later<br>";
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
<label for="10MC">10th Marks Card</label>
<input type="file" name="10MC" class="form-control" id="10MC" />
<br>
<input type='text' value="<?php echo $MC10;?>" readonly class='form-control' placeholder='10th grade marks card not uploaded'>
</div>

<div class="form-group">
<label for="12MC">12th Marks Card</label>
<input type="file" name="12MC" class="form-control" id="12MC"/>
<br>
<input type='text' value="<?php echo $MC12;?>" readonly class='form-control' placeholder='12th grade marks card not uploaded'>
</div>
<div class="form-group">
<label for="CMC">College Marks Card</label>
<input type="file" name="CMC" class="form-control" />
<br>
<input type='text' value="<?php echo $CMC;?>" readonly class='form-control' placeholder='College marks card not uploaded'>
</div>

</div>
<div class="col-md-6">
<div class="form-group">
<label for="cgpa">CGPA</label>
<input type="text" name="cgpa" class="form-control" placeholder="CGPA" value="<?php echo $cgpa;?>" required pattern="\d\d.\d\d"/>
</div>

<div class="form-group">
<label for="industry">10th Grade Percentage </label>
<input type='text' name="m10" id="m10" class="form-control" placeholder="10th Grade Percentage" value="<?php echo $m10;?>" pattern="\d\d.\d\d" />
</div>

<div class="form-group">
<label for="industry">12th Grade Percentage </label>
<input type='text' name="m12" id="m12" class="form-control" placeholder="12th Grade Percentage" value="<?php echo $m12;?>" pattern="\d\d.\d\d" />
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
