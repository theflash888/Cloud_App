<?php
// Bucket Name
$bucket="vedut";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIAT2YV7GKBSV2XVQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
?>