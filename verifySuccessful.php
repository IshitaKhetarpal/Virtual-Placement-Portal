<!--Used by the employer to Accept a candidates application-->
<?php

	include 'authorizeEmployer.php';
	if(isset($_GET['s_id']))
	{
		$s_id = $_GET['s_id'];  
        include 'connect.php';
        $sql = "update verified set status=1 where sv_id='$s_id';";
        $result=$conn->query($sql);
        header('location: ViewVerifications.php');
	}
	else
	{     
		header('location: index.php?msg=error');
	}
	die();
