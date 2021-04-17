<?php

// Create connection
    include 'authorizeEmployer.php';
	require 'start.php';
    $id=0;
    $c_name=$role=$cgpa=$ctc=$eType=$reqs=$category=$inductry=$status=$jd=$msg="";
    if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') 
    {
        include 'connect.php';
        if(isset($_GET['update'])&& isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql="select * from post where o_id=$o_id and id=$id"; 
            $result = $conn->query($sql);
            if(  $row=$result->fetch_assoc())
            {
                $c_name= $row['c_name'];
				$role=$row['role'];
				$cgpa=$row['cgpa'];
                $ctc=$row['ctc'];
				$eType=$row['employmentType'];
				$reqs=$row['reqs'];
                $category=$row['category'];
                $branch=$row['branch'];                              
                $status=$row['status'];
				$jd=$row['jd'];
            }
        } 
    
        if(isset($_POST['submitPost']))
        {	

            $id= $_POST['id'];
            $c_name= $_POST['c_name'];
			$role=$_POST['role'];
			$cgpa=$_POST['cgpa'];
            $ctc=$_POST['ctc'];
			$eType=$_POST['eType'];
			$reqs=$_POST['reqs'];
            $category=$_POST['category'];            
            $branch=implode(",",$_POST['subs']);                                   
            $status=$_POST['status'];   
			
			if(isset($_FILES["jd"]) && $_FILES["jd"]["error"] == 0) 
			{
				$umsg="";
				$Fname= basename($_FILES["jd"]["name"]);
				$uploadOk = 1;
				$fileType = strtolower(pathinfo($Fname,PATHINFO_EXTENSION));
				$temp_name=$_FILES["jd"]["tmp_name"];
					
				// Check file size
				if ($_FILES["jd"]["size"] > 5000000) 
				{
					$umsg.= " The file ". $fileName." is too large<br>";
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($fileType != "txt" && $fileType != "doc" && $fileType != "docx" && $fileType != "pdf" )
				{
					$umsg.= " Only txt, doc, docx & pdf files are allowed -->".$fileName."<br>";
					$uploadOk = 0;
				}
					
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 1)
				{				
					try
					{
						$result = $s3Client->putObject([
						'Bucket' => $config['s3']['bucket'],
						'Key' => 'jd/'.$Fname,
						'Body' => fopen($temp_name,'rb'),
						'ACL'=>'public-read'							
						]);
						$jd=$Fname;
					}
					catch(Exception $e)
					{
						$umsg.= "Sorry there was an error uploading the JD<br>";
					}
				}
				else 
				{	
					$umsg.=  "Sorry not uploaded<br>";
						
				}
				$msg.= "<br>".$umsg;
			}
		
				
			if($id>0)
			{
				$sql = "Update `post` set `date`=CURRENT_DATE(),"
				. "`c_name`='$c_name', "
				. "`role`='$role', "
				. "`cgpa`='$cgpa', "
				. "`ctc`='$ctc', "
				. "`employmentType`='$eType', "
				. "`reqs`='$reqs', "
				. "`category`='$category', "															
				. "`branch`='$branch', "										
				. "`status`= '$status' ,"
				. "`jd`= '$jd'"
				. "where id=$id and o_id=$o_id;";        
			}
			else
			{       
				$sql = "INSERT INTO `post` (`id`, `date`, `o_id`, `c_name`, `role`, `cgpa`, `ctc`, `employmentType`, `reqs`, `category`, `branch`, `status`,`jd`) "
				. "VALUES (NULL, CURRENT_DATE(), '$o_id', '$c_name', '$role', '$cgpa', '$ctc', '$eType', '$reqs', '$category', '$branch', '$status','$jd');";
			}

			if ($conn->query($sql) === TRUE) 
			{
				if($_GET['update'])
				{
					$msg.=" UPDATED";
				}
				else
				{
					$msg.= " New Post has been created successfully";
				}
			}
			else 
			{
				$msg.= " Error: Please try again later<br>";
			}
		}
	}


?>
 

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Post a Job </title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link href="css/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet">
</head>

<body onload="logoBeat()" style="font-family: 'Kodchasan', sans-serif;">
<?php 
	include 'navBar.php'; 
	echo "<div class='container-fluid' style='background-color:#3bb3e0;'>";
    include 'connect.php';
    $o_id = $_SESSION["o_id"];
?>
	
<div class="hero" >
<div class="container contact-form" style=" background-image: url('img/back1.png'); box-shadow: 0px 0px 25px #1e1e1e;">
<div class="contact-image" >
<img src="img/rocket_contact.png"style=" background-image: url('img/bgbg.png'); box-shadow: 0px 0px 25px #1e1e1e;" alt="rocket_contact"/>
</div>
<form id="post_job" name="jobs" action="" method="post" enctype="multipart/form-data" onsubmit="return valthisform(this);">	
<h3 style="margin-top:-100; font-weight:bold; font-size:30">Post a JOB</h3>
<div class="row">
<div style="color:white; margin-bottom:50; font-size:20"><?php echo $msg;?></div>
<input type='hidden' value="<?php echo $id;?>" name='id'/>
<div class="col-md-6">

<div class="form-group">
<label for="c_name" style="color:white; font-size:16">Company Name:</label>                            
<input type="text" name="c_name" class="form-control" placeholder="Company Name" value="<?php echo $c_name;?>" required />
</div>

<div class="form-group">
<label for="role" style="color:white; font-size:16">Role</label>
<input type="text" name="role" class="form-control" placeholder="Role" value="<?php echo $role;?>" required />
</div>

<div class="form-group">
<label for="cgpa" style="color:white; font-size:16">CGPA Cut-Off</label>
<input type="text" name="cgpa" class="form-control" placeholder="CGPA" value="<?php echo $cgpa;?>" required pattern="\d\d.\d\d" />
</div>
<div class="form-group">
<label for="ctc" style="color:white; font-size:16">Proposed CTC</label>
<input type="text" name="ctc" class="form-control" placeholder="Proposed CTC" value="<?php echo $ctc;?>" required />
</div>
<div class="form-group" >
<label for="eType" style="color:white; font-size:16">Employment Type</label>
<select type="text" name="eType" class="form-control" >
<option value="FTE + Internship">FTE + Internship</option>
<option value="FTE">FTE</option>
<option value="Internship">Internship</option>
</select>
</div>
<div class="form-group">
<label for="reqs" style="color:white; font-size:16">Job requirements</label>
<textarea name="reqs" class="form-control" placeholder="Job Requirements (Not more than 200 characters)" style="width: 100%; height: 108px;" maxlength="195"><?php echo $reqs;?></textarea>
</div>
</div>


<div class="col-md-6">
<label for="branches" style="color:white; font-size:16">Branches Eligible</label>
<br>
<input type="checkbox" name="subs[]" value="CIV" > 
<label style="color:white;"> Civil Engineering </label>
<br>
<input type="checkbox" name="subs[]" value="CSE"  > 
<label style="color:white;"> Computer Science Engineering</label>
<br>
<input type="checkbox" name="subs[]" value="EEE" > 
<label style="color:white;"> Electrical and Electronics Engineering </label>
<br>
<input type="checkbox" name="subs[]" value="ECE"> 
<label style="color:white;">  Electronics and Communication Engineering</label>
<br>
<input type="checkbox" name="subs[]" value="ISE"> 
<label style="color:white;">Information Science Engineering</label>
<br>
<input type="checkbox" name="subs[]" value="ME"> 
<label style="color:white;"> Mechanical Engineering</label>
<br>
<input type="checkbox" name="subs[]" value="TCE"> 
<label style="color:white;">  Telecommunication Engineering</label>
<br>


<div class="form-group">
<label for="category" style="color:white; font-size:16">Job Category</label>
<select type="text" name="category" class="form-control" placeholder="Category">
<?php include 'categoryOptions.php';?> 
</select>
</div>

<div class="form-group">
<label for="jd" style="color:white; font-size:16">Job Description(JD)</label>
<input type="file" id="jd" name="jd" required >
</div>

<label style="color:white; font-size:16; margin-top:13">Status</label><br>
<label class="radio-inline" style="color:white;">
<input type="radio" name="status" value="1"  <?php if($status=='1'){echo "checked='true'";}?>>Open
</label>
<label class="radio-inline" style="color:white;">
<input type="radio" name="status" value='0' <?php if($status=='0'){echo "checked='true'";}?>>Closed
</label> 

<div class="form-group">
<button type="submit" name="submitPost" class="btnContact pull-right" > Post Job</button>
</div></div></div>
</form>
</div></div></div>
       
<!--first row -->
<script type="text/javascript">
function valthisform(jobs)
{
    var checkboxs=document.getElementsByName("subs[]");
	var radios=document.getElementsByName("status");
    var okay1=okay2=false;
    for(var i=0,l=checkboxs.length;i<l;i++)
    {
        if(checkboxs[i].checked)
        {
            okay1=true;
            break;
        }
    }
	for(var i=0,l=radios.length;i<l;i++)
    {
        if(radios[i].checked)
        {
            okay2=true;
            break;
        }
    }
	
    if(okay1==false && okay2==false)
	{
		alert("Please select one or more eligible branches and set the job status");
		return false;
	}
	else if (okay1==false)
	{
		alert("Please select one or more eligible branches");
		return false;
	}
	else if (okay2==false)
	{
		alert("Please select the job status");
		return false;
	}
	else
		return true;
}
</script>
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>

<?php include 'footer.php';?>

</body></html>