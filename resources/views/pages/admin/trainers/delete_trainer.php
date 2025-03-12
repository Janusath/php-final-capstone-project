<?php

$id = $_GET["id"];

// Fetch trainer details to get the image filename before deleting
$sql = "SELECT image FROM trainers WHERE id = ?";
if ($fetchStmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($fetchStmt, "i", $id);
    mysqli_stmt_execute($fetchStmt);
    $result = mysqli_stmt_get_result($fetchStmt);
    $trainer = mysqli_fetch_assoc($result);
    mysqli_stmt_close($fetchStmt); // Close statement after execution

    if ($trainer) {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . "../public/images/" . $trainer['image'];

        // Delete the image if it exists
        if (!empty($trainer['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}


// Delete trainer from the trainers table
$sql = "DELETE FROM trainers WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);  // "i" indicates an integer type
if (mysqli_stmt_execute($stmt)) {
    $_SESSION['success'] = "Trainer deleted successfully!";
    header("Location: ?page=trainers/show_trainer");
} else {
    $_SESSION['error'] = "Failed to delete trainer: " . mysqli_error($conn);
}

exit();
?>

