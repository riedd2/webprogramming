<!DOCTYPE html>
<html>
<head>
<?php include "Controller/LoginController.php"; ?>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
<link rel="stylesheet" type="text/css" href="css/layout.css">
<link rel="stylesheet" type="text/css" href="css/format.css">
<script src="script/jquery-2.1.1.min.js"></script>
</head>
<body>

	<div id="Header">
		<img src="img/logo.jpg">
		This is the header
		<div class="login" align="right">
			<?php
			
			if (isset ( $_SESSION ["user"] )) {
				echo "Welcome " . $_SESSION ["user"] . "<a href='Controller/logout.php'> log out</a>";
			} else {
				echo '<form action="index.php" method="post"><input name="user" /> User Name<br /> <input type="password"	name="pw" /> Password<br /> <input type="submit" value="Login"/></form>';
			}
			
			?>	
		</div>
	</div>
	
	
	<div id="Content">
		<div id="Navigation">
			<!-- Accordion -->
			<h2 class="demoHeaders">Accordion</h2>
			<div id="accordion">
				<h3>Products</h3>
				<ul>
					<li><a href="view/catalog.php?filter="HDD">"HDD</a></li>
					<li>Mainboard</li>
				</ul>
				<h3>Account</h3>
				<ul>
					<li>Basked</li>
					<li>Settings</li>
				</ul>
				<h3>Wizard</h3>
				<ul>
					<li>Start</li>
					<li>Introduction</li>
				</ul>
			</div>
		</div>
		<div id="Info">this is info panel</div>
		<div id="Main">Main Content</div>
	</div>
		<script src="js/jquery/external/jquery/jquery.js"></script>
		<script src="js/jquery/jquery-ui.js"></script>
		<script>
	

$( "#accordion" ).accordion();



var availableTags = [
	"ActionScript",
	"AppleScript",
	"Asp",
	"BASIC",
	"C",
	"C++",
	"Clojure",
	"COBOL",
	"ColdFusion",
	"Erlang",
	"Fortran",
	"Groovy",
	"Haskell",
	"Java",
	"JavaScript",
	"Lisp",
	"Perl",
	"PHP",
	"Python",
	"Ruby",
	"Scala",
	"Scheme"
];
$( "#autocomplete" ).autocomplete({
	source: availableTags
});



$( "#button" ).button();
$( "#radioset" ).buttonset();



$( "#tabs" ).tabs();



$( "#dialog" ).dialog({
	autoOpen: false,
	width: 400,
	buttons: [
		{
			text: "Ok",
			click: function() {
				$( this ).dialog( "close" );
			}
		},
		{
			text: "Cancel",
			click: function() {
				$( this ).dialog( "close" );
			}
		}
	]
});

// Link to open the dialog
$( "#dialog-link" ).click(function( event ) {
	$( "#dialog" ).dialog( "open" );
	event.preventDefault();
});



$( "#datepicker" ).datepicker({
	inline: true
});



$( "#slider" ).slider({
	range: true,
	values: [ 17, 67 ]
});



$( "#progressbar" ).progressbar({
	value: 20
});



$( "#spinner" ).spinner();



$( "#menu" ).menu();



$( "#tooltip" ).tooltip();



$( "#selectmenu" ).selectmenu();


// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script>

</body>
</html>