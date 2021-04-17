<script src="js/tilt.jquery.min.js"></script>

<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
require 'start.php';

if(isset($_GET['jd']))
{		
	$name=$_GET['jd'];
	$keyname='jd/'.$name;
}
if(isset($_GET['resume']))
{		
	$name=$_GET['resume'];
	$keyname='resume/'.$name;
}
if(isset($_GET['cmc']))
{		
	$name=$_GET['cmc'];
	$keyname='CMC/'.$name;
}
if(isset($_GET['mc12']))
{		
	$name=$_GET['mc12'];
	$keyname='MC12/'.$name;
}
if(isset($_GET['mc10']))
{		
	$name=$_GET['mc10'];
	$keyname='MC10/'.$name;
}

$bucketname=$config['s3']['bucket'];	
try
{
	$result=$s3Client->getObject([
	'Bucket' => $bucketname,
	'Key' => $keyname
	]);
	header("Content-Type: application/pdf");
	header("Content-Disposition: inline");
	echo $result['Body'];
}
catch(Exception $e)
{
	//echo $e->getMessage().PHP_EOL;
	
?>
	<script type='text/javascript'>
	window.close();
	alert("Sorry, the requested file has not been uploaded.");
	</script>
<?php
	
}
?>


	