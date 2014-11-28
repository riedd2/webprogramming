<?php include "Controller/LoginController.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
 
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <div class="row"> 
   <div class="col-md-4"><h1>Logo</h1></div>
   <div class="col-md-4">Middle</div>
   <div class="col-md-4">
   				<?php
			
			if (isset ( $_SESSION ["user"] )) {
				echo "Welcome " . $_SESSION ["user"] . "<a href='Controller/logout.php'> log out</a>";
			} else {
				echo '<form action="index.php" method="post"><input name="user" /> User Name<br /> <input type="password"	name="pw" /> Password<br /> <input type="submit" value="Login"/></form>';
			}
			
			?>	
			
			<button type="button" class="btn btn-default btn-lg">Login</button>
   </div>
   
   </div>
    
<div class="row">
<div class="col-md-3">
<ul class="nav nav-pills nav-stacked">
<li role="presentation" class="active"><a href="#">Home</a></li>
  <li role="presentation"><a href="view/catalog.php?filter=HDD">HDD</a></li>
  <li role="presentation"><a href="#">Messages</a></li>	
</ul>

</div>
<div class="col-md-6">Main</div>
<div class="col-md-3">Infopanel</div>
</div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>