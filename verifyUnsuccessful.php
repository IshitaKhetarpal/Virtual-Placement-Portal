<?php

    include 'authorizeEmployer.php';
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;
	require 'vendor/autoload.php';
	require 'start.php';
	$bucketname=$config['s3']['bucket'];
	if(isset($_GET['s_id']))
	{
		$s_id = $_GET['s_id'];  
        include 'connect.php';
        $sql = "update verified set status='-1' where sv_id='$s_id';";
        if($conn->query($sql)==TRUE)
		{
			$sql1 = "select * from seekermarks where sm_id='$s_id';";
			$res=$conn->query($sql1);
			if($res->num_rows>0)
			{	
				$row=$res->fetch_assoc();
				$resume=$row['resume'];
				$mrc10=$row['mrc10'];
				$mrc12=$row['mrc12'];
				$mrcc=$row['mrcc'];
			}
			if($resume!=NULL)
			{
				$keyname='resume/'.$resume;
				try
				{
					$result=$s3Client->deleteObject([
					'Bucket' => $bucketname,
					'Key' => $keyname
					]);
				}
				catch(Exception $e)
				{
				}
			}
			if($mrc10!=NULL)
			{
				$keyname='MC10/'.$mrc10;
				try
				{
					$result=$s3Client->deleteObject([
					'Bucket' => $bucketname,
					'Key' => $keyname
					]);
				}
				catch(Exception $e)
				{
				}
			}
			if($mrc12!=NULL)
			{
				$keyname='MC12/'.$mrc12;
				try
				{
					$result=$s3Client->deleteObject([
					'Bucket' => $bucketname,
					'Key' => $keyname
					]);
				}
				catch(Exception $e)
				{
				}
			}
			if($mrcc!=NULL)
			{
				$keyname='CMC/'.$mrcc;
				try
				{
					$result=$s3Client->deleteObject([
					'Bucket' => $bucketname,
					'Key' => $keyname
					]);
				}
				catch(Exception $e)
				{
				}
			}
			$sql2= "delete from seekermarks where sm_id=$s_id;";
			if( $conn->query($sql2) == TRUE )
			{
				header('location: ViewVerifications.php');
			}
			else
			{
				header('location: index.php?msg=error');
			}
		}
		else
		{     
			header('location: index.php?msg=error');
		}
	}
	die();