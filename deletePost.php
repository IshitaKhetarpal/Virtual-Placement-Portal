<?php

    include 'authorizeEmployer.php';
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;
	require 'vendor/autoload.php';
	require 'start.php';
	$bucketname=$config['s3']['bucket'];
    if(isset($_GET['id']))
    {
        include 'connect.php';
        $id = $_GET['id'];
		$sql= "select jd from post where id='$id';";
		if($conn->query($sql)==TRUE)
		{
			$res=$conn->query($sql);
			if($res->num_rows >0)
			{
				$temp=$res->fetch_assoc();
				$jd=$temp['jd'];
				if($jd!=NULL)
				{
					$keyname='jd/'.$jd;
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
				$sql1 = "delete from post where id=$id";   
				if ($conn->query($sql1) === TRUE) 
				{
					header('location: employerAccount.php');
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
        else
        {
            header('location: index.php?msg=error');
        }
    }
