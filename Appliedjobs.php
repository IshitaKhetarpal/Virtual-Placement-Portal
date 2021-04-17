<!-- Used by candidate to view the jobs theyve applied for-->

<?php include 'authorizeSeeker.php';?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Applied Jobs </title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery-3.3.1.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link href="css/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/kodchasan.css" rel="stylesheet">
<style>
    .tiltContain{ margin-top:0%; } 
    .btnTilt{ height: 75px;background:rgba(225,225,225,0.2) ;  color:white; font-family: Comfortaa; }
    .textDarkShadow{ text-shadow: 0px 0px 3px #000,3px 3px 5px #003333; }
</style>

<body onload="logoBeat()" style="font-family: 'Kodchasan', sans-serif;">

<?php include 'navBar.php'; ?>
    
<!-- Main Container -->
<div class="container-fluid" style="background:url('img/polaroid.png');">
<?php
    include 'connect.php';
    $sql = "select S.name, SC.email from seeker S, seekercred SC where S.s_id = '$s_id' and SC.sc_id='$s_id' and S.s_id=SC.sc_id ;";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // output data of each row
        if($row = $result->fetch_assoc()) 
        { 
            $name=  $row["name"];
            $email =  $row["email"];         
        }
    } 
?>
<div class="hero" >	
<div style="width: 100%; " class="row" >		  
	<center>
	<div class="col-md-6">	
    <h4><br><br><br><br>Candidate Name:</h4>
    <h2><?php echo $name; ?></h2>
	</div>
	<div class="col-md-6">
    <h4><br><br><br><br>Email ID:</h4>
    <h2><?php echo $email; ?></h2>
	</div>
	</center>
</div>
		
<div style=" height: 100vh; margin-top:5% " class="col-md-12">
<center>
<div><h2><b>Jobs Applied by you:<b><br><br></h2></div>
<table class="table table-hover table-responsive table-striped" id='jobappliedTable'>
<thead>

<th>Company Name</th>
<th>Job Role</th>                            
<th>Date Applied</th>
<th>Salary</th>
<th>Status</th>                               
</thead>
<tbody>
<?php 
    $sql="select c_name,ctc,(select date from jobsapplied where pid=post.id and s_id='$s_id')as date,(select status from jobsapplied where pid=post.id and s_id='$s_id')as appstatus, role  from post where id in (select pid from jobsapplied where s_id='$s_id');"; 
    $appresult = $conn->query($sql);
    if ($appresult->num_rows > 0) 
    {
        // output data of each row
        while($row = $appresult->fetch_assoc()) 
		{
           
            $company=$row['c_name'];
            $date=$row['date'];
            $ctc=$row['ctc'];
            $status=$row['appstatus'];
			if($status==0)
			{
				$s_msg="Waiting for Approval";
			}
			else if($status==1)
			{
				$s_msg="Accepted";
			}
			else
			{
				$s_msg="Rejected";
			}
			$role=$row['role'];
?> <!--Breaking out of php-->
            <tr>
            
            <td><?php echo $company;?></td>
            <td><?php echo $role;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $ctc;?></td>          
            <td><?php echo $s_msg;?></td>
            </tr>
<?php
		}		
    }  
?> <!--Closing the if and while of above-->                               
</tbody>
</table></center>
</div></div></div></div>
<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>
<?php include 'footer.php';?>
<script>
$(document).ready(function() { $('#jobappliedTable').DataTable(); } );
</script>
</body>
</html>
