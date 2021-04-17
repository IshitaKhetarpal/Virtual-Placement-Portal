<!--Used by Organisation to Verify Candidate Details -->

<?php include 'authorizeEmployer.php';?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title>Unverified Registrations </title>
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
?>

<div class="hero" >
<div style="width: 100%;margin-top 5%; height:100vh" class="row" >

<div style=" height: 100vh; margin-top:5% " class="col-md-12">
<center>
<div><h2>New/Unupdated Registrations:<br><br></h2></div>

<table class="table table-hover table-responsive table-striped" id='jobappliedTable'>
<thead>
	<th>USN</th>
	<th>Name</th>
	<th>Branch</th>
	<th>Email</th>
	<th>Phone</th>
</thead>
<tbody>                                
<?php 
    $sql="select S.usn,S.name, S.branch, S.phone,SC.email from seeker S, seekercred SC, verified V where S.s_id=SC.sc_id and S.s_id=V.sv_id and V.status=-1 and S.o_id=$o_id;";
    $unverified_res = $conn->query($sql);
    if ($unverified_res->num_rows > 0) 
    {
        while($row = $unverified_res->fetch_assoc()) 
        {
			$s_id=$row['s_id'];
            $usn=$row['usn'];  
            $sname=$row['name'];
            $sbranch = $row['branch'];
            $email=$row['email'];
			$phone=$row['phone'];
?>
            <tr>
                    <td><?php echo $usn;?></td>
                    <td><?php echo $sname;?></td>
                    <td><?php echo $sbranch;?></td>
                    <td><?php echo $email;?></td>
                    <td><?php echo $phone;?></td>                                
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