<!--Used by the employer to Reject a candidates application-->


<?php

	include 'authorizeEmployer.php';
	if(isset($_GET['id']) and isset($_GET['pid']))
	{
		$s_id = $_GET['id'];  
		$pid = $_GET['pid'];
        include 'connect.php';
        $sql = "update jobsapplied set status='-1' where s_id='$s_id' and pid='$pid';;";
        $result=$conn->query($sql);
        header('location: viewJobApplicants.php');
	}
	else
	{     
		header('location: index.php?msg=error');
	}
	die();
