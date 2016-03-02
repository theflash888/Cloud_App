<?php
// Bucket Name
$bucket="vedut";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJVYIEAMBXS3GYS7A');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

$s3 = new S3(awsAccessKey, awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
?>