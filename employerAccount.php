<!-- For the employer to view their account -->

<?php include 'authorizeEmployer.php';?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"><link rel="icon" href="images/homepage/favicon.ico" type="image/x-icon">
<title> Admin Page </title>
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
    $sqlE = "select O.name,O.logo,OC.email from organisation O, orgcred OC where O.o_id = '$o_id' and O.o_id=OC.oc_id ;";  
    $resultE = $conn->query($sqlE);
    if ($resultE->num_rows > 0) 
    {
        // output data of each row
        if($rowE = $resultE->fetch_assoc()) 
        { 
            $name=  $rowE["name"];
            $email =  $rowE["email"];
            $logo = $rowE["logo"];
        }   
    }
?>
<div class="hero" >	
<div style="width: 100%; " class="row" >		
<div class="col-md-4"  >
    <img src="uploads/<?php echo $logo;?>" class="img-circle img-responsive" width="200" style="margin: 20%; box-shadow: 0px 0px 20px #1e1e1e;">
</div>
<div class="col-md-4"  >
	<br><br><br><br>
    <h3>Organization Name: </h3>
    <h2><?php echo $name; ?></h2>
</div>
<div class="col-md-4"  >
	<br><br><br><br>
    <h3>Email: </h3>
    <h2><?php echo $email; ?></h2>
</div>		
<center>
<div style=" height: 100vh" class="col-md-12">
    <div><h2><strong>Jobs Posted:</strong></h2></div>
    <table class="table table-hover table-responsive table-striped" id='postTable'>
    <thead>
        <th>Company</th>
        <th>Role</th>
        <th>CGPA Cut-Off</th>
        <th>Proposed CTC</th>
		<th>Branches Eligible</th>
		<th> JD </th>
        <th>Status</th>
        <th>Update</th>
        <th>Delete</th>
    </thead>
    <tbody>   
        <?php 
            $sql="select * from post where o_id=$o_id"; 
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
                // output data of each row
                while($row = $result->fetch_assoc()) 
                {	
					$id=$row['id'];
                    $c_name=$row['c_name'];
					$role=$row['role'];    
                    $cgpa=$row['cgpa'];
                    $ctc=$row['ctc'];
					$branch=$row['branch'];
                    $jd=$row['jd'];                            
                    $status=$row['status'];
?>
                    <tr>
                        <td><?php echo $c_name;?></td>
                        <td><?php echo $role;?></td>
                        <td><?php echo $cgpa;?></td>
                        <td><?php echo $ctc;?></td>
						<td><?php echo $branch;?></td>
                        <td><?php echo $jd;?></td>
                        <td><?php echo $status;?></td>
                        <td>
                        <a href="postjob.php?update=true&id=<?php echo $id;?>"> <span class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                        <td>
                        <a href="deletePost.php?id=<?php echo $id;?>"> <span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
<?php
                }                
            }  
?>   
                    
</tbody></table></div></div></div>  
</div>

<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>
<?php include 'footer.php';?>
<script>
$(document).ready(function() { $('#postTable').DataTable(); } );
</script>
</body>
</html>