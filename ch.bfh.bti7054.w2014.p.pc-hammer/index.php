<?php 
session_start ();
include "language/lang.php";
include "Controller/LoginController.php";
include "class/helper.php";

function __autoload($class_name) {
	include 'class\\'. $class_name . '.inc.php';
}

#### settings ####
# smarty configuration
require('/vendor/smarty/smarty/libs/Smarty.class.php');
global $smarty;

$smarty = new Smarty();
$smarty->setTemplateDir('vendor/smarty/templates');
$smarty->setCompileDir('/vendor/smarty/templates_c');

# image URL
$imgpath = "img/";

# default page
$default = 'home.php';

# set document root path
$base = 'view\\';

# list of all site pages + the id they will be called by
$pages = array('home' => 'home.php','catalog' => 'catalog.php','contact' => 'contact.php', '_admin' => 'admin.php', '_checkout' => 'checkout.php', '_confirmation' => 'confirmation.php');

#### settings END ####


/**
 * @param string $targetPage
 * @param array $lang
 * @return string navigation link a href
 */
function GetNavigationLink($targetPage, $lang){
	if(Helper::startsWith($targetPage, "_")){
		if($targetPage == "_admin" && isset($_SESSION['admin'])){
			return "<a href='?page=".$targetPage."'>".$lang[$targetPage]."</a>";
		}
		return "<a href='?page=".$targetPage."' style='display:none'>".$targetPage."</a>";
	}
	return "<a href='?page=".$targetPage."'>".$lang[$targetPage]."</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>pchammer</title>
	
	<!-- Bootstrap -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	
	<style type="text/css">
		#footer {
		   bottom:0;
		   width:100%;
		   height:60px;   
		   background: #337AB7;
		   color: white;
		   padding: 10px;
		   clear: both;
	       position: fixed;
		}
	</style>
</head>
<body>
	<?php 
	if (isset($_GET['page'])){
		$currentPage = $_GET['page'];
	}else{
		$currentPage = "";
	}
	
	//remember current filter
	$filter = isset($_GET['filter']) ? "&filter=".$_GET['filter'] : "";
	//remember current search
	$search = isset($_GET['search']) ? "&search=".$_GET['search'] : "";
	//remember current location for weather service
	$location = isset($_GET['location']) ? "&location=".$_GET['location'] : "";
	
	$germanHREF = "?page=".$currentPage."&lang=de".$filter.$search.$location;
	$englishHREF = "?page=".$currentPage."&lang=en".$filter.$search.$location;
	
	?>
			
	<div style="margin-left:10px; margin-top:10px; height: 100%; margin-bottom: 100px;">
		<div class="row">
			<div class="col-md-3">
				<a href="index.php"><img src="img/logo.png" height="130px" /></a>
			</div>
			<div class="col-md-6"></div>
			<div class="col-md-3">
				<div class='btn-group' role='group' aria-label='...'>
					<a href="<?php echo $englishHREF?>"><button class ="btn btn-default" ><?php echo $lang['english']?></button></a>
					<a href="<?php echo $germanHREF?>"><button class ="btn btn-default" ><?php echo $lang['german']?></button></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<form action="index.php" method="get">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="search">
						<div class="input-group-btn">
							<button class="btn btn-default" type="submit">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
					<input type="text" hidden="true" name="page" value="catalog" />
				</form>
			</div>
			<div class="col-md-3">
			<?php
				//show logout if user is logged in and login form when not logged in
				if (isset ( $_SESSION ["user"] )) {
					echo "Welcome ".$_SESSION ["user"]."<a href='Controller/logout.php'> ".$lang['logout']."</a>";
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
					//generate navigation
					foreach($pages as $key => $value){
						if(!isset($_GET['page']) && $key == 'home'){
							echo "<li role='presentation' class='active'>".GetNavigationLink($key, $lang)."</li>";
						}
						else if(isset($_GET['page']) && $_GET['page'] == $key){
							echo "<li role='presentation' class='active'>".GetNavigationLink($key, $lang)."</li>";
						}else{
							echo "<li role='presentation'>".GetNavigationLink($key, $lang)."</li>";
						
						}
					}
					?>
				</ul>
			</div>
			<div class="col-md-6">
				<?php 
				//load page depending on page variable saved in GET
				if(isset($_GET['page'])){
					//check if page exists in our pages array
					if(array_key_exists($_GET['page'], $pages))
					{
						//include correct view
						foreach($pages as $pageid => $pagename) {
							if($_GET['page'] == $pageid && file_exists($base.$pagename))
							{
								include $base.$pagename;
							}
						}
					}
					else {
						//if page doesnt exist in our pages array simply show the default page
						if(file_exists($base.$default)) include $base.$default;
					}
				}
				else {
					//if no page is selected simply show the default page
					if(file_exists($base.$default)) include $base.$default;
				}	
				?>
			</div>
			<div class="col-md-3">
				<?php 
				//show cart if user is logged in
				if (isset ( $_SESSION ["user"] )) {
					include "view/cart.php";
				}
				?>
			</div>
		</div>	
	</div>
	<div id="footer">
		<?php echo $lang['codedby']?> | <?php echo $lang['currenttime'] ?><span id="time"></span>
	</div>
	
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	
	<script type="text/javascript">
		//initialize tooltip for cart (bootstrap)
		$(function () {
			  $('[data-toggle="tooltip"]').tooltip();
			});	

		//update the time in the footer
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
	            v+="AM";
	        }
	        setTimeout("updateTime()",1000);
	        document.getElementById('time').innerHTML=v;
	    }
	    updateTime();
	</script>	
</body>
</html>
