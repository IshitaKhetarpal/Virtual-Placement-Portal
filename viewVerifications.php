<!--Used by Organisation to Verify Candidate Details -->

<?php include 'authorizeEmployer.php';?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Verification </title>
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
    $sql = "select O.name,OC.email from organisation O, orgcred OC where O.o_id = '$o_id' and O.o_id=OC.oc_id ;";      
    $result = $conn->query($sql);   
    if ($result->num_rows > 0) 
    {
        if($row = $result->fetch_assoc()) 
        { 
            $name=  $row["name"];
            $email =  $row["email"];
        }
    }
	$sql1="select count(status) as stat from verified V, seeker S  where V.sv_id=S.s_id and S.o_id=$o_id and status=-1";
	$result = $conn->query($sql1);   
    if ($result->num_rows > 0) 
    {
        if($row = $result->fetch_assoc()) 
        { 
            $new= $row["stat"];
        }
    }
	$sql2="select count(status) as stat from verified V, seeker S where V.sv_id=S.s_id and S.o_id=$o_id and status=0";
	$result = $conn->query($sql2);   
    if ($result->num_rows > 0) 
    {
        if($row = $result->fetch_assoc()) 
        { 
            $unverified= $row["stat"];
        }
    }
	$sql3="select count(status) as stat from verified V, seeker S  where V.sv_id=S.s_id and S.o_id=$o_id and status=1";
	$result = $conn->query($sql3);   
    if ($result->num_rows > 0) 
    {
        if($row = $result->fetch_assoc()) 
        { 
            $verified= $row["stat"];
        }
    }
?>

<div class="hero" >
<div style="width: 100%;margin-top 5%; height:100vh" class="row" >
<center>
	<div class="col-md-6" >
	<h4 style="margin-top:75">Organization Name: <h2><?php echo $name; ?></h2></h4>
	</div>
	<div class="col-md-6" >
	<h4 style="margin-top:75">Email:</h4> <h2><?php echo $email; ?></h2>
	</div>
	<div class="col-md-4" >
	<h4 style="margin-top:50">Candidates Verified:</h4> 
	<h2><a href="viewVerified.php" target="_blank" style="color:black; font-size:28"><?php echo $verified; ?></a></h2>
	</div>
	<div class="col-md-4" >
	<h4 style="margin-top:50">Candidates Unverified:</h4> <h2 style="color:black; font-size:28; font-weight:bold"><?php echo $unverified; ?></h2>
	</div>
	<div class="col-md-4" >
	<h4 style="margin-top:50">New/Unupdated Registrations:</h4> 
	<h2><a href="viewUnverifiedRegs.php" target="_blank" style="color:black; font-size:28"><?php echo $new; ?></a></h2>
	</div>
		
	
</center>
<div style=" height: 100vh; margin-top:2% " class="col-md-12">
<center>
<div><h2>Verification Requests:<br><br></h2></div>

<table class="table table-hover table-responsive table-striped" id='jobappliedTable'>
<thead>
	<th>USN</th>
	<th>Name</th>
	<th>Branch</th>
	<th>10th %</th>
	<th>12th %</th>
	<th>CGPA</th>
	<th>10th MC</th>
	<th>12th MC</th>
	<th>College MC</th>
	<th>Resume</th>
	<th>Verify</th>
	<th>Reject</th>
</thead>
<tbody>                                
<?php 
    $sql="select S.s_id,S.usn,S.name, S.branch, SM.m10, SM.m12,SM.cgpa,SM.mrc10,SM.mrc12,SM.mrcc, SM.resume from seeker S, seekermarks SM, verified V  where S.s_id=SM.sm_id and S.s_id=V.sv_id and V.status=0 and S.o_id=$o_id;";
    $unverified_res = $conn->query($sql);
    if ($unverified_res->num_rows > 0) 
    {
        while($row = $unverified_res->fetch_assoc()) 
        {
			$s_id=$row['s_id'];
            $usn=$row['usn'];  
            $sname=$row['name'];
            $sbranch = $row['branch'];
            $m10=$row['m10'];
            $m12=$row['m12'];
            $cgpa=$row['cgpa'];
            $mrc10=$row['mrc10'];
            $mrc12=$row['mrc12'];
			$mrcc=$row['mrcc'];
			$resume=$row['resume'];
?>
            <tr>
                    <td><?php echo $usn;?></td>
                    <td><?php echo $sname;?></td>
                    <td><?php echo $sbranch;?></td>
                    <td><?php echo $m10;?></td>
                    <td><?php echo $m12;?></td>
                    <td><?php echo $cgpa;?></td>
					<td><a href="getting.php?mc10=<?= $mrc10; ?>" target="_blank" style="color:red"> View </a></td>
					<td><a href="getting.php?mc12=<?= $mrc12; ?>" target="_blank" style="color:red"> View</a></td>
					<td><a href="getting.php?cmc=<?= $mrcc; ?>" target="_blank" style="color:red"> View</a></td>
					<td><a href="getting.php?resume=<?= $resume; ?>" target="_blank" style="color:red"> View</a></td>
                    <td><a href="verifySuccessful.php?s_id=<?php echo $s_id;?>"><span class="glyphicon glyphicon-ok"></span></a></td>
                    <td><a href="verifyUnsuccessful.php?s_id=<?php echo $s_id;?>"><span class="glyphicon glyphicon-ban-circle"></span></a></td>                                  
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