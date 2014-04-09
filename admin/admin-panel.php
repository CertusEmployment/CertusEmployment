<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>

	<link rel="stylesheet" type="text/css" href="../styles/main.css" media="screen" />
	<link rel="stylesheet" href="../font-awesome-4.0.3/css/font-awesome.min.css">

</head>
<body>

<div id="container">
	
	<?php include "../toolbar-admin.php"; ?>

	<div id="wrapper">

		<div id="logo">
			<img src="../images/certus_logo.png" />
		</div>

		<div class="content-block">
			<table class="profiletable">
				<tr><th collspan="2">Account informatie</th></tr>
				<tr>
					<td>Gebruikersnaam</td>
					<td></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><small><a href="#">E-mail wijzigen</a></small></td>
				</tr>
				<tr>
					<td>Wachtwoord</td>
					<td><small><a href="#">Wachtwoord wijzigen</a></small></td>
				</tr>
			</table>
		</div>

		<div class="content-block">
			<table>
				<tr><th collspan="4">Recente screenings</th></tr>
				<tr>
					<td>Jos Dubben</td>
					<td>Randstad</td>
					<td>vandaag</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Jo Bonten</td>
					<td>Olympia</td>
					<td>Gisteren</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Roy Donders</td>
					<td>Start People</td>
					<td>20-02-2014</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
			</table>
		</div>

		<div class="screening-list">
			<form name="filter" id="filter">
				<select>
					<option>januari</option>
					<option>februari</option>
					<option>maart</option>
					<option>april</option>
					<option>mei</option>
					<option>juni</option>
					<option>juli</option>
					<option>augustus</option>
					<option>september</option>
					<option>oktober</option>
					<option>november</option>
					<option>december</option>
				</select>

				<select>
					<option>2009</option>
					<option>2010</option>
					<option>2011</option>
					<option>2012</option>
					<option>2013</option>
					<option>2014</option>
				</select>

				<input type="text" name="filter" placeholder="FILTER">
			</form>
			<table>
				<tr class="table-header">
					<th>Bedrijfsnaam</th>
					<th>Contactpersoon</th>
					<th>Postcode</th>
					<th>Plaats</th>
					<th>Lopende screenings</th>
					<th>Profiel</th>
				</tr>
				<tr>
					<td>Randstad</td>
					<td>Linda Huls</td>
					<td>4569 DC</td>
					<td>Utrecht</td>
					<td>2</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Randstad</td>
					<td>Linda Huls</td>
					<td>4569 DC</td>
					<td>Utrecht</td>
					<td>2</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Randstad</td>
					<td>Linda Huls</td>
					<td>4569 DC</td>
					<td>Utrecht</td>
					<td>2</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Randstad</td>
					<td>Linda Huls</td>
					<td>4569 DC</td>
					<td>Utrecht</td>
					<td>2</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
				<tr>
					<td>Randstad</td>
					<td>Linda Huls</td>
					<td>4569 DC</td>
					<td>Utrecht</td>
					<td>2</td>
					<td class="cursive"><a href="#">link</a></td>
				</tr>
			</table>
		</div>

		<?php include "../footer.php"; ?>

		





	</div>
</div>
</body>
</html>