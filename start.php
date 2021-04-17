<?php

	require 'vendor/autoload.php';
	use Aws\S3\S3Client;
	use Aws\Exception\AwsException;
	
	$config=require('config.php');
	$s3Client = new S3Client([
    'region' => 'ap-south-1',
    'version' => '2006-03-01',
	'credentials' => [
		'key'=>$config['s3']['key'],
		'secret'=>$config['s3']['secret']
		]
]);