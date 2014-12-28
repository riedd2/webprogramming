<?php
function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
   
}
   
   session_start();
   session_unset(); // ... delete all session variables,
   session_destroy(); // ... and end it
   
   
   redirect("/index.php");

?>