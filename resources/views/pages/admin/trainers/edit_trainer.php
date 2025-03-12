<?php
// Get the trainer ID from the URL
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    // Get the updated form values
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $twitter_link = $_POST['twitter_link'];
    $facebook_link = $_POST['facebook_link'];
    $instagram_link = $_POST['instagram_link'];
    $linkedin_link = $_POST['linkedin_link'];
    $description = $_POST['description'];

    // Initialize the image upload path
    $imageName = "";
    

    // If an image is uploaded, handle the file upload
    if ($_FILES['image']['error'] === 0) {
        // Generate a new image name
        $imageName = time() . "_" . basename($_FILES["image"]["name"]);
        $imagePath = "../public/images/" . $imageName;

        // Move the uploaded image to the target directory
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "File upload failed.";
            exit();
        }
    } else {
        // If no new image is uploaded, retain the current image
        $sql = "SELECT image FROM trainers WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $trainer = mysqli_fetch_assoc($result);
        $imageName = $trainer['image'];
    }

    // Update the trainer's details in the database
    $sql = "UPDATE trainers SET name = ?, subject = ?, description = ?, twitter_link = ?, facebook_link = ?, instagram_link = ?, linkedin_link = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $name, $subject, $description, $twitter_link, $facebook_link, $instagram_link, $linkedin_link, $imageName, $id);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Trainer updated successfully!";
        header("Location: ?page=trainers/show_trainer");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


// Fetch existing trainer details for editing

    $sql = "SELECT * FROM trainers WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $trainer = mysqli_fetch_assoc($result);
    if (!$trainer) {
        $_SESSION['error'] = "Trainer not found.!";
        exit();
    }

?>

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
            <h5 class="card-title">Edit Trainer Details</h5>
            <form method="post" enctype="multipart/form-data">
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" value="<?php echo $trainer['name']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Subject</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="subject" value="<?php echo $trainer['subject']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="twitter_link" value="<?php echo $trainer['twitter_link']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="facebook_link" value="<?php echo $trainer['facebook_link']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="instagram_link" value="<?php echo $trainer['instagram_link']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputText" class="col-sm-2 col-form-label">LinkedIn</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="linkedin_link" value="<?php echo $trainer['linkedin_link']; ?>" required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                <div class="col-sm-10">
                  <input class="form-control" type="file" id="formFile" name="image">
                  <?php
                   if ($trainer['image']) {
                     ?>
                    <img src="../public/images/<?php echo $trainer['image']; ?>" width="100" alt="Current Image">
                  <?php } ?>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" style="height: 100px" name="description"><?php echo $trainer['description']; ?></textarea>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Submit Button</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" name="submit" value="submit">Update Trainer</button>
                </div>
              </div>
            </form><!-- End General Form Elements -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->  