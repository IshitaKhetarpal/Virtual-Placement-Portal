<!doctype html>
<!-- Main/First page -->

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Online Job Portal</title>
<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/Animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
<div class="container-fluid" style=" background-image: url('img/mainBackg.jpg'); background-position: center; background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">	
<div class="hero" style=" color:whitesmoke;" >
<h1 style="padding:50px; font-size: 70px; text-align:center"><strong> JOB PORTAL</strong></h1>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
<?php 
include 'notset_idx.php';
include 'empset_idx.php';
include 'candi_idx.php';
 ?>
<!---------------------------------------------------------------------------------------------------------------------------------------------->                      
</div> </div>       

<!--first row -->
 
<script src="js/tilt.jquery.min.js"></script>
<script src="js/signinModal.js"></script>
<?php include 'footer.php';?>

<button  style="display:none;" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#msgModal" id="msgModalBtn">Open Modal</button>
<!-- Modal -->
<div id="msgModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<?php 
    if(isset($_GET['msg']))
    {
        $msg= $_GET['msg'];
        if($msg=='success')
        {    
            echo  "<h4 class='modal-title'>Job Applied Successfully!</h4>";
        }
        else if($msg=='error')
        {
            echo  "<h4 class='modal-title'>Some Error occured, Please try again later!</h4>";
        }
        else if($msg=='dup')
        {
            echo "<h4 class='modal-title'>You have already applied for this job.<br> "
              . "Check your application status in 'Jobs Applied' section</h4>";
        }
		else if($msg=='exists')
        {
            echo  "<h4 class='modal-title'>User already exists. Please log-in to continue. </h4>";
        }
		else if($msg=='failed')
        {
            echo  "<h4 class='modal-title'>You do not meet the required eligibility criteria.<br>"
					."Please try for other jobs.</h4>";
        }
		else if($msg=='update')
        {
            echo  "<h4 class='modal-title'>Please update and verify your details by your TPO to apply for jobs.<br></h4>";
        }
	}
?>
</div></div></div></div>

<?php 
    
    if(isset($_GET['msg']))
    {
        
?>
            <script>
                $('#msgModalBtn').trigger( "click" );
            </script>       
<?php  
         
    }
	
?> 
</body>
</html>