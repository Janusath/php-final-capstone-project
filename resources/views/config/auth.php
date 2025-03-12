<?php

if (!isset($_SESSION['id'])) {

  // $loginPath = $_SERVER['DOCUMENT_ROOT'] . "/php-final-capstone-project/resources/views/pages/admin/authentication/login.php";
  // header("Location: " . $loginPath);

  // or
  
  header("Location: /php-final-capstone-project/resources/views/pages/admin/authentication/login.php ");

    exit();
}
?>