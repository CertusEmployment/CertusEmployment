<head>
	<title>Get Hash!</title>
</head>

<body>

<?php

if(!isset($_POST['submit'])) {
	$posting = false;
} else {
	$temp = htmlentities(strip_tags(trim($_POST['password'])));
	echo "<b>sha1 hash:</b> " .hash('sha1',$temp). "<br>";
	echo "<b>password: </b>" .$temp;
	$posting = false;
}

if(!$posting) {

?>

<form method="post">
	<input type="text" name="password" style="margin-top: 10px;" />
	<input type="submit" name="submit" value="Get Hash!" />
</form>

<?php

}

function randomPassword() {
    	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    	$pass = array();
    	$alphaLength = strlen($alphabet) - 1;
    	for ($i = 0; $i < 8; $i++) {
    	    $n = rand(0, $alphaLength);
    	    $pass[] = $alphabet[$n];
    	}
    	return implode($pass);
	}

?>
<br>
<b>Random Password:</b> <?php echo $random = randomPassword(); ?>

</body>