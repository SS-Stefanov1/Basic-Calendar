<?php
session_start();

function secure($var)
{
    return htmlspecialchars(trim($var));
}

?>

<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link type="text/css" rel="stylesheet" href="/css/style.css"/>
   </head>

   <body class="homepage">
      <h1><a href="/calendar.php"></a></h1>
   </body>
</html>
