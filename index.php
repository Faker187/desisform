<?php
   define('assets_url', './assets/');
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Styles -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
         rel="stylesheet" 
         integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
         crossorigin="anonymous">
      <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

      <!-- Custom Styles -->
      <link rel="stylesheet" href="./assets/css/style.css">
      <title>Desis Test Formulario Votación</title>
   </head>
   <body>
      <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <!-- Main -->
        <?php  
        
        require_once './config/database.php';
        $dbCon = new DbConnector();
        $dbCon = $dbCon->GetConnection();
        include('./view/FormPage.php')  
        
        ?>
      </div>
   </body>
   
   <!-- Scripts -->
   <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
   <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

   <!-- Custom Script -->
   <script src="<?=assets_url?>js/functions.js"></script>
</html>