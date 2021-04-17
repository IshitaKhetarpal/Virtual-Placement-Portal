<!-- For registering a candidate-->

<?php

    include 'connect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
    
		$name = $_POST["name"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$institute = $_POST["institute"];
		$usn=strtoupper($_POST["usn"]);
		$branch=$_POST["branch"];
		$tel=$_POST["tel"];
		$dob=$_POST["dob"];
		
		//Check if user already exists
		$sql="select sc_id from seekercred where email='$email';";
		$sql1="select s_id from seeker where usn='$usn';";
		$res=$conn->query($sql);
		$res1=$conn->query($sql1);
		if($res->num_rows>0 || $res1->num_rows>0)
		{
			header('location:index.php?msg=exists');
			die();
		}
		$sql="select o_id from organisation where name like '$institute';";
		$res=$conn->query($sql);
		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
			$o_id=$row['o_id'];
		}
		
        $sql = "INSERT INTO seeker (name,o_id,usn,branch,phone,dob) VALUES ('$name', '$o_id','$usn', '$branch','$tel', '$dob')";
        if ($conn->query($sql) === TRUE)
        {
			$sql1= "Select s_id from seeker where usn='$usn';";	
			$res=$conn->query($sql1);
			$ans=$res->fetch_assoc();
			$s_id=$ans['s_id'];
			$sql2="INSERT INTO seekercred (sc_id,email,password) values('$s_id','$email','$password');";
			$sql3="INSERT INTO verified (sv_id,usn) values('$s_id','$usn');";
			if($conn->query($sql2) == TRUE and $conn->query($sql3) == TRUE)
			{			
?>
				<html>
				<head>
				<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
				<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
				<link href="css/Animate.css" rel="stylesheet" type="text/css">
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
				</head>
				<body style="background: url(img/bgbg.png);height: 100vh;">
				<div style="">
				</div>
			
				<!-- Trigger the modal with a button -->
				<button id="modalBtn" type="button" style="display:none" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
				<div class="modal-header">        
				<h3 >Thanks for Registering with us.<br>Please login to continue using our services</h3><br>
				<a href="index.php" style="float:right">Login</a>
				</div></div></div></div>    
				<script>
					$('#modalBtn').trigger("click");
				</script>
				</body>
				</html>

<?php		
			}
			else 
			{
				header('location:index.php?msg=error');
			}
			$conn->close();
		}
		else 
		{
			header("location : index.php?msg=error");
		}
    }
    else
    {
        header("location : index.php");
    }
?>