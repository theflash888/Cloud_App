<?php
	include('image_check.php');
	session_start();

	// store session data
if (isset($_SESSION['id']))
$_SESSION['id'] = $_SESSION['id']; // or if you have any algo.

	if(!isset($_COOKIE['loggedin'])){
		header("location:index.php");
	}

	$msg='';
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['file']['name'];
			$size = $_FILES['file']['size'];
			$tmp = $_FILES['file']['tmp_name'];
			$ext = getExtension($name);

	if(strlen($name) > 0)
	{
		if(in_array($ext,$valid_formats))
		{
			if($size<(1024*1024))
			{
				include('s3_config.php');
				$actual_image_name = time().".".$ext;

			if($s3->putObjectFile($tmp, $bucket , $actual_image_name, S3::ACL_PUBLIC_READ) )
			{
				$msg = "S3 Upload Successful.";
				$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
				echo "<img src='$s3file'/>";
				echo 'S3 File URL:'.$s3file;
			}
			else
			$msg = "S3 Upload Fail.";

			}
			else
			$msg = "Image size Max 1 MB";

			}
			else
			$msg = "Invalid file, please upload image file.";

			}
			else
			$msg = "Please select image file.";

			}

?>

<html>
	<body>
		<h1>Welcome!</h1>
		<a href="logout.php">Logout</a>

<head>
		<script type="text/javascript">
			function startTime() {
				var d=new Date();
				var h=d.getHours();
				var m=d.getMinutes();
				var s=d.getSeconds();
				document.getElementById("txt").innerHTML=h+ " : "+m+" : "+s;
				setTimeout('startTime()', 1000);
			}
		</script>

	<script>
		function countDown(secs,elem) {
			var element = document.getElementById(elem);
			element.innerHTML = "Please wait for "+secs+" seconds your surprise!";
			if(secs < 1) {
				clearTimeout(timer);
				element.innerHTML = '<h2>Countdown Complete!</h2>';
				element.innerHTML += '<a href="surprise.php">Click here now</a>';
			}
			secs--;
			var timer = setTimeout('countDown('+secs+',"'+elem+'")',1000);
		}
		</script>
		<div id="status"></div>
		<script>countDown(10,"status");</script>

		<style type="text/css">
			h1 {
				font-size: 50px;
			}
			img {
			    position: relative;
			    float: left;
			    width:  100px;
			    height: 50px;
			    background-position: 50% 50%;
			    background-repeat:   no-repeat;
			    background-size:     cover;
}
		</style>
</head>

<body bgcolor="" text="black" onload="startTime()">
	<br>
	<h1 align="center">
		<span id="txt"></span>
	</h1>

<body bgcolor="" text="black" onload="countDown()">
	<br>
	<h1 align="center">
		<span id="txt"></span>
	</h1>



<div align="right">
		<form action="login_success.php" method='post' enctype="multipart/form-data" align="left">
		Upload image file here
		<input type='file' name='file'/> <input type='submit' value='Upload Image'/>
		<?php echo $msg; ?>
		</form>

		<?php
			$xml = simplexml_load_file('https://s3.amazonaws.com/vedut');
			echo "<pre>";
			foreach($xml->Contents as $img)
			{
		?>
			<img src="https://s3.amazonaws.com/vedut/<?php echo $img->Key; ?>">
		<?php
			}
		?>

		<ul id="CharsName">
			
		</ul>
</div>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<!--  <div align="right">

<script>$.get("https://restcountries.eu/rest/v1/all", function(data, status){
        console.log(data);
        for(var d in data)
        {
        	$("#CharsName").append("<li>" + data[d].alpha2Code + "</li>");
        }
    });
</script>
</div> -->



	</body>
</html>