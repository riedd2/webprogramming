<?php 
include "language/lang.php";
include_once "class/cart.inc.php";
session_start ();
include "Controller/LoginController.php";


function __autoload($class_name) {
	include 'class\\'. $class_name . '.inc.php';
}

# default page
$default = 'home.php';

# set document root path
$base = 'view\\';

# list of all site pages + the id they will be called by
$pages = array('home' => 'home.php','catalog' => 'catalog.php','contact' => 'contact.php', 'admin' => 'admin.php');




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>pchammer</title>

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
<div style="margin-left:10px">
	<div class="row">
		<div class="col-md-3">
			<h1>Logo</h1>
		</div>
		<div class="col-md-6">
		</div>
		<div class="col-md-3">
			<div class='btn-group' role='group' aria-label='...'>
			<?php 
			if (isset($_GET['page'])){
				$currentPage = $_GET['page'];
			}else{
				$currentPage = "";
			}
			
			$germanHREF = "?page=".$currentPage."&lang=de";
			$englishHREF = "?page=".$currentPage."&lang=en";
			
			?>
				<a href="<?php echo $englishHREF?>"><button class ="btn btn-default" ><?php echo $lang['english']?></button></a>
				<a href="<?php echo $germanHREF?>"><button class ="btn btn-default" ><?php echo $lang['german']?></button></a>
			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-3">left</div>
		<div class="col-md-6">

			<form action="index.php" method="get">

				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search"
						name="search">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</div>
				</div>
				<input type='textbox' hidden name='page' value='catalog' />
			</form>



		</div>
		<div class="col-md-3">
		<?php
		
			if (isset ( $_SESSION ["user"] ) && isset($_SESSION ["admin"])) {
				echo "Welcome Admin " . $_SESSION ["user"] . "<a href='Controller/logout.php'> ".$lang['logout']."</a>";
				echo "</br> <a href='?page=admin'>".$lang['adminmenu']."</a>";
			}else if (isset ( $_SESSION ["user"] )) {
				echo "Welcome " . $_SESSION ["user"] . "<a href='Controller/logout.php'> ".$lang['logout']."</a>";
			}else {
				echo "<form action='index.php' method='post'><input name='user' /> User Name<br /> <input type='password' name='pw' /> ".$lang['password']."<br /> <button type='submit' class='btn btn-default btn-lg'>".$lang['login']."</button></form>";
			}
		
		?>	
			
			
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<ul class="nav nav-pills nav-stacked">
				<?php 
				foreach($pages as $key => $value){
					if(!isset($_GET['page']) && $key == 'home'){
						echo "<li role='presentation' class='active'><a href='?page=".$key."'>".$key."</a></li>";
					}
					else if(isset($_GET['page']) && $_GET['page'] == $key){
						echo "<li role='presentation' class='active'><a href='?page=".$key."'>".$key."</a></li>";
					}else{
						echo "<li role='presentation'><a href='?page=".$key."'>".$key."</a></li>";
					}
				}
				?>
			</ul>

		</div>
		<div class="col-md-6">
		<?php 
		if(isset($_GET['page'])){
			if(array_key_exists($_GET['page'], $pages))
			{
				foreach($pages as $pageid => $pagename) {
					if($_GET['page'] == $pageid && file_exists($base.$pagename))
					{
						/* if somebody's making a request for ?page=xxx and
						 the page exists in the $pages array, we display it
						 checking first it also exists as a page on the server */
						include $base.$pagename;
					}
				} // end foreach
			}
			else {
				/* if the page isn't listed in $pages, or there's no ?page=xxx request
				 we show the default page, again we'll also just make sure it exists as a file
				 on the server */
				if(file_exists($base.$default)) include $base.$default;
			}
		}
		else {
			/* if no page is set, display default page */
			if(file_exists($base.$default)) include $base.$default;
		}
			
		
		?>
		
		
		
		</div>
		<div class="col-md-3">
		<?php 
		if (isset ( $_SESSION ["user"] )) {
			
			include "view/cart.php";
		}
		?>
		</div>
	</div>
	<div class="row" style="margin-bottom:10px;">
	Current Time: <span id="time" />
	</div>
</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
	//initialize tooltip for cart (bootstrap)
	$(function () {
		  $('[data-toggle="tooltip"]').tooltip()
		});	
		
    function updateTime() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        if (minutes < 10){
            minutes = "0" + minutes;
        }
        if (seconds < 10){
            seconds = "0" + seconds;
        }
        var v = hours + ":" + minutes + ":" + seconds + " ";
        if(hours > 11){
            v+="PM";
        } else {
            v+="AM"
        }
        setTimeout("updateTime()",1000);
        document.getElementById('time').innerHTML=v;
    }
    updateTime();
    //-->
</script>	
	
	</script>
</body>
</html>
