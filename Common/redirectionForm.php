<?php
//This file automatically redirects to the payment pages

session_start();

?>

<!DOCTYPE html>
<html lang = "en">
<head>
   <meta charset = "UTF-8">
   <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
   <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
   <title>Redirection Form</title>
</head>
<body>
   <form id = "form" method = "POST" action = "<?php echo $_SESSION['redirectionUrl']; ?>">
      <input type = "hidden" name = "redirectionVersion" value = "<?php echo  $_SESSION['redirectionVersion']; ?>"/>
      <input type = "hidden" name = "redirectionData" value = "<?php echo  $_SESSION['redirectionData']; ?>"/>
   </form>
   <script type = "text/javascript">
      document.getElementById("form").submit();
   </script> 
</body>
</html>