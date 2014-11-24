<?php
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
   
}
   
   session_start();
   session_unset(); // ... delete all session variables,
   session_destroy(); // ... and end it
   
   
   redirect("http://localhost/webprogramming/ch.bfh.bti7054.w2014.p.pc-hammer/index.php");

?>