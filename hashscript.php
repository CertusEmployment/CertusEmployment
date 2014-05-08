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

?>

</body>