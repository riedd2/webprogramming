<!DOCTYPE html>
<html>
<head>
<?php include "Controller/LoginController.php"; ?>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css"
	href="/webprogramming/ch.bfh.bti7054.w2014.p.pc-hammer/css/layout.css">
<link rel="stylesheet" type="text/css"
	href="/webprogramming/ch.bfh.bti7054.w2014.p.pc-hammer/css/format.css">
</head>
<body>
	<script src="script/jquery-2.1.1.min.js"></script>
	<div id="Header">
		<img
			src="/webprogramming/ch.bfh.bti7054.w2014.p.pc-hammer/img/logo.jpg">
		This is the header
		<div class="login" align="right">
		<?php 
	
		if (isset($_SESSION ["user"])) {
					echo "Welcome ".$_SESSION ["user"]."<a href='Controller/logout.php'> log out</a>";
				}
		else{
			  echo '<form action="index.php" method="post"><input name="user" /> User Name<br /> <input type="password"	name="pw" /> Password<br /> <input type="submit" value="Login"/></form>';
		}
				
				
				?>
			
		</div>
	</div>
	<div id="Content">
		<div id="Navigation">
			<ul>

<li>test</li>
				<li>test</li>
			</ul>

		</div>
		<div id="Info">this is info panel</div>
		<div id="Main">Main Content</div>
	</div>
</body>
</html>