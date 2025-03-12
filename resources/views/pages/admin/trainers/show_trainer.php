<main id="main" class="main">

    <div class="pagetitle">
        <h1>Data Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <?php
                // Check for success message
                if (isset($_SESSION['success'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']);
                }

                // Check for error message
                if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                }
                ?>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>
                        
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Facebook</th>
                                        <th>Instagram</th>
                                        <th>LinkedIn</th>
                                        <th>Twitter</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                    $sql = "SELECT * FROM trainers;";
                                    $stmt = mysqli_prepare($conn, $sql);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["name"] . "</td>";
                                        echo "<td>" . $row["subject"] . "</td>";
                                        echo "<td>" . $row["description"] . "</td>";      
                                        echo "<td><a href='" . $row["facebook_link"] . "' target='_blank'>Facebook</a></td>";
                                        echo "<td><a href='" . $row["instagram_link"] . "' target='_blank'>Instagram</a></td>";
                                        echo "<td><a href='" . $row["linkedin_link"] . "' target='_blank'>LinkedIn</a></td>";
                                        echo "<td><a href='" . $row["twitter_link"] . "' target='_blank'>Twitter</a></td>";
                                        
                                        
                                        // Show the image
                                        echo "<td><img class='img-fluid img-thumbnail' src='../public/images/" . $row["image"] . "' alt='Trainer Image' width='80' height='80'></td>";


                                        echo "<td>
                                        <a href='index.php?page=trainers/edit_trainer&id=" . $row['id'] . "' class='btn btn-primary me-2'>
                                            <i class='fa-solid fa-pen-to-square'></i> Edit
                                        </a> 
                                        <a href='index.php?page=trainers/delete_trainer&id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirmDelete()'>
                                            <i class='fa-solid fa-trash'></i> Delete
                                        </a>
                                      </td></tr>";
                                    }

                                    ?>

                                    <script>
                                        function confirmDelete() {
                                                return confirm("Are you sure you want to delete this trainer?");
                                            }
                                    </script>
                                </tbody>
                            </table>
                        </div><!-- End Table Responsive -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

</script>
