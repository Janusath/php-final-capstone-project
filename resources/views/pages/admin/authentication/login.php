
<?php
session_start();
if (isset($_SESSION['id'])) {

 
  header("Location: ../../../../../admin/index.php");

    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Login - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../../../public/admin/assets/img/favicon.png" rel="icon">
  <link href="../../../../../public/admin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../../../../public/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../../../public/admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../../../../public/admin/assets/css/style.css" rel="stylesheet">



  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php

include("../../../config/db.php");


if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit'])){

  $email=$_POST['email'];
  $password=$_POST['password'];

  $sql="SELECT id,username,password FROM users WHERE email=?";
  $stmt=mysqli_prepare($conn,$sql);
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);

  if(mysqli_stmt_num_rows($stmt)>0){
    mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
    mysqli_stmt_fetch($stmt);

    if(password_verify($password,$hashed_password)){
      $_SESSION['id']=$id;
      $_SESSION['username']=$username;
      // header("Location: ../../../../../admin/index.php");
      // or
      header("Location: /php-final-capstone-project/admin/index.php");
  
      exit;

    }else{
      $_SESSION['error']="Invalid email or password";
    }
 
  }

  else{
    $_SESSION['error']="Invalid email or password";
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);

}

?>



<?php


if(isset($_SESSION['success'])){

  echo '<div class="alert alert-success" role="alert">'.$_SESSION["success"].'</div>'; unset($_SESSION["success"]);
}

elseif(isset($_SESSION['error'])){

  echo '<div class="alert alert-danger" role="alert">'.$_SESSION["error"].'</div>'; unset($_SESSION["error"]);

}?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="../../../../../public/admin/assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">NiceAdmin</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="post" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit" value="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="./register.php">Create an account</a></p>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../../../../public/admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../../../../public/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../../../public/admin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../../../../public/admin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../../../../public/admin/assets/vendor/quill/quill.js"></script>
  <script src="../../../../../public/admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../../../../public/admin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../../../../public/admin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../../../../public/admin/assets/js/main.js"></script>

</body>

</html>