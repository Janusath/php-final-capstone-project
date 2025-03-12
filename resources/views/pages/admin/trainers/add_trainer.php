<main id="main" class="main">

<div class="pagetitle">
  <h1>Form Elements</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Elements</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Trainers Details</h5>

          <!-- General Form Elements -->
          <form method="post" enctype="multipart/form-data">
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Subject</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="subject" required>
              </div>
            </div>
          
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">X</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="twitter_link" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Facebook</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="facebook_link" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Instagram</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="instagram_link" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputText" class="col-sm-2 col-form-label">Linkdin</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="linkedin_link" required>
              </div>
            </div>
       
            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" id="formFile" name="image" required>
              </div>
            </div>
        
            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label">Textarea</label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" name="description"></textarea>
              </div>
            </div>
           
        
            <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Submit Button</label>
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit Form</button>
              </div>
            </div>

          </form><!-- End General Form Elements -->

        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->


<?php

// include $_SERVER['DOCUMENT_ROOT']."/PHP-FINAL-CAPSTONE-PROJECT/resources/views/config/db.php";
// include __DIR__ . "/../../../config/db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $twitter_link = $_POST['twitter_link'];
    $facebook_link = $_POST['facebook_link'];
    $instagram_link = $_POST['instagram_link'];
    $linkedin_link = $_POST['linkedin_link'];
    $description = $_POST['description'];

    // absolute path
    // $uploadImage = $_SERVER['DOCUMENT_ROOT'] . "/PHP-FINAL-CAPSTONE-PROJECT/public/images";

    // relative path
    //  $uploadImage = "../public/images/";
    // $uploadImage= realpath("../public/images"); //convert relative path to absolute path
    


    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    // $imagePath = $uploadImage . "/" . $imageName;
    $imagePath = "../public/images/". $imageName;

    if ($_FILES['image']['error'] === 0) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $sql = "INSERT INTO trainers(name,subject,description,twitter_link,facebook_link,instagram_link,linkedin_link,image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ssssssss', $name, $subject, $description, $twitter_link, $facebook_link, $instagram_link, $linkedin_link, $imageName);
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['success'] = "Trainer added successfully!";
                header("Location: ?page=trainers/show_trainer");
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "File upload error: " . $_FILES['image']['error'];
    }
}

?>
