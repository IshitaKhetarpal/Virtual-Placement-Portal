<!--Used by candidates to apply for jobs-->

<?php

    if(isset($_GET['id']))
    {
		$pid = $_GET['id'];
		session_start();
		if(isset($_SESSION['s_id']))
		{
			include 'connect.php';
			$s_id = $_SESSION['s_id'];
				
			$sql = "select * from jobsapplied where pid='$pid' and s_id='$s_id';";
			$result=$conn->query($sql);
			$count=$result->num_rows;
			if($count>0)
			{
				header('location: index.php?msg=dup');
				die();
			}
			
			$res_check=$conn->query("select status from verified where sv_id=$s_id;");
			$row_check=$res_check->fetch_assoc();
			$check=$row_check['status'];
			if($check!=1)
			{
				header('location: index.php?msg=update');
				die();
			}
				
			//To check if the CGPA cut off is met
			$result_jp=$conn->query("select cgpa from post where id=$pid;");
			$result_cp=$conn->query("select cgpa from seekermarks where sm_id=$s_id;");
			$row_jp = $result_jp -> fetch_assoc();
			$row_cp = $result_cp -> fetch_assoc();
			$j_cgpa=$row_jp['cgpa'];	
			$c_cgpa=$row_cp['cgpa'];
				
			//To check is the branch eligibility is met
			$result_jb=$conn->query("select branch from post where id=$pid;");
			$result_cb=$conn->query("select branch from seeker where s_id=$s_id;");
			$row_jb= $result_jb -> fetch_assoc();
			$row_cb= $result_cb -> fetch_assoc();
			$jb=$row_jb['branch'];
			$j_branch= explode(",",$jb);
			$c_branch=$row_cb['branch'];
			
			if( $j_cgpa <= $c_cgpa and in_array($c_branch, $j_branch))
			{
				$sql = "INSERT INTO `jobsapplied` (`id`, `date`, `pid`, `s_id`, `status`) VALUES (NULL, CURRENT_DATE(), '$pid', '$s_id', 0);";
				if ($conn->query($sql) === TRUE) 
				{
					header('location: index.php?msg=success');
				}
				else
				{
					header('location: index.php?msg=error');
				}
			}
			else
			{
				header('location: index.php?msg=failed');
				die();	
			}
		}
		else
		{
				header('location:index.php?msg=login');
		}
    }