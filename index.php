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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


      <script>
         $(document).ready(function(){
            $( ".calendarButton" ).on( "click", function() {
               var x = $( this ).parent().parent().attr('rel');
               console.log(x);
               var date = x.split("-");
               var day = date[2];
               console.log(day)
               $( this ).attr('href','http://127.0.0.1/hours.php?d='+day)
               $( this )[0].click();
            });
         });
      </script>
      <h1><a href="/calendar.php"></a></h1>
   </body>
</html>
