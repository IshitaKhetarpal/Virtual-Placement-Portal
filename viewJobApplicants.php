<!--Used by Employer to view Candidates who have applied for their job postings-->

<?php include 'authorizeEmployer.php';?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Job Applicants </title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link href="css/animate.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Kodchasan" rel="stylesheet">
<style>
    .tiltContain{margin-top:0%;} 
    .btnTilt{height: 75px;background:rgba(225,225,225,0.2) ;  color:white; font-family: Comfortaa;}
    .textDarkShadow{ text-shadow: 0px 0px 3px #000,3px 3px 5px #003333; }
    
</style>
<body onload="logoBeat()" style="font-family: 'Kodchasan', sans-serif;">

<?php include 'navBar.php'; ?>
    
<!-- Main Container -->
<div class="container-fluid" style="background:url('img/polaroid.png');">
<?php
    include 'connect.php';
    $sql = "select O.name, Oc.email from organisation O, orgcred OC where o_id = '$o_id' and O.o_id=OC.oc_id ;";      
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
<div style="width: 100%;margin-top 5%; height:100vh" class="row" >
<div class="col-md-8"  >
	<p>
	<h4><br><br><br>Organization Name: <h2><?php echo $name ?></h2></h4>
	</p>
	<h4><br>Email</h4>
	<h2><?php echo $email; ?></h2>
</div>

<div style=" height: 100vh; margin-top:2% " class="col-md-12">
<center>
<div><h2>Applications received:<br><br></h2></div>
<table class="table table-hover table-responsive table-striped" id='jobappliedTable'>
<thead>
	<th>Company Name</th>
	<th>Date Applied</th>
	<th>Applicant Name</th>
	<th>USN</th>
	<th>Branch</th>
	<th>Email</th>
	<th>Phone</th>
	<th>View Resume</th>
	<th>Status</th>
	<th>Accept</th>
	<th>Reject</th>
</thead>
<tbody>                                
<?php 
    $sql1="select P.c_name, J.date, S.s_id, S.name, S.usn, S.branch, S.phone, SC.email, SM.resume,J.status, J.pid from jobsapplied J, post P, seeker S, seekercred SC, seekermarks SM where S.s_id=J.s_id and P.id=J.pid and S.s_id=SC.sc_id and S.s_id=SM.sm_id and P.o_id=S.o_id and S.o_id=$o_id";

    $appresult = $conn->query($sql1);
    if ($appresult->num_rows > 0) 
    {
        // output data of each row
        while($row = $appresult->fetch_assoc()) 
        {
			$s_id=$row['s_id'];
            $c_name=$row['c_name'];
			$date=$row['date'];
            $sname = $row['name'];
            $usn=$row['usn'];
			$branch=$row['branch'];
            $email=$row['email'];
            $phone=$row['phone'];
            $resume=$row['resume'];
			$status=$row['status'];
			$pid=$row['pid'];
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
?>
            <tr>
                    <td><?php echo $c_name;?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $sname;?></td>
                    <td><?php echo $usn;?></td>
                    <td><?php echo $branch;?></td>
                    <td><?php echo $email;?></td>
					<td><?php echo $phone;?></td>
                    <td><a href="getting.php?resume=<?= $resume; ?>" target="_blank" style="color:red"> View</a></td>
					<td><?php echo $s_msg;?></td>
                    <td><a href="acceptApplication.php?id=<?php echo $s_id;?>&pid=<?php echo $pid;?>"><span class="glyphicon glyphicon-ok"></span></a></td>
                    <td><a href="rejectApplication.php?id=<?php echo $s_id;?>&pid=<?php echo $pid;?>"><span class="glyphicon glyphicon-ban-circle"></span></a></td>                                  
            </tr>
<?php
        }        
    }  
?>
</tbody></table></center>
</div>
</div></div></div>
  
<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>
<?php include 'footer.php';?>
<script>
$(document).ready(function() { $('#jobappliedTable').DataTable(); } );
</script>
</body>
</html>