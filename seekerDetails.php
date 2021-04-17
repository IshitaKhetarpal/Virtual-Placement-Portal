<?php

// Create connection
	include 'authorizeSeeker.php';
	include 'connect.php';
	$s_id=$_SESSION["s_id"];
	$sql="select status from verified where sv_id=$s_id;";
	if($conn->query($sql)==TRUE)
	{
		$res=$conn->query($sql);
		if($res->num_rows >0)
		{
			$temp=$res->fetch_assoc();
			$status=$temp['status'];
			if($status==-1)
			{	
				include 'unupdatedCandidateDetails.php';
			}
			else
			{
				include 'updatedCandidateDetails.php';
			}
		}
	}
?>
	