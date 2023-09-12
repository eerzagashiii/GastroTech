<?php
require 'db.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['update'])) {
        // Retrieve and sanitize form data
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
        $comments = mysqli_real_escape_string($con, $_POST['comments']);

        // Construct the SQL update query
        $update_query = "UPDATE feedback SET name='$name', feedback='$feedback', comments='$comments' WHERE id=$id";

        // Execute the update query
        $exec = mysqli_query($con, $update_query);

        if ($exec) {
            // Successfully updated, you can redirect or perform other actions here
            header("Location: view_feedback.php");
            exit();
        } else {
            echo mysqli_error($con);
        }
    }

    if (isset($_POST['cancel'])) {
        header("Location: view_feedback.php");
        exit();
    }
} else {
    // Handle the case where "id" is not defined or empty in the URL
    echo "Invalid or missing 'id' parameter in the URL.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Feedback</title>
</head>
<body>
    <h2>Update Feedback</h2>
    <form method="post" action="#">
        <?php
        require 'db.php';
        $id = $_GET['id'];
        $q = mysqli_query($con, "SELECT * FROM feedback WHERE id = $id");
        $r = mysqli_fetch_array($q);
        ?>
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $r['name']; ?>" required>
        </div>
        <div class="form-group">
            <label>Feedback:</label>
            <textarea class="form-control" name="feedback" required><?php echo $r['feedback']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Comments:</label>
            <textarea class="form-control" name="comments" required><?php echo $r['comments']; ?></textarea>
        </div>
        <button style="margin-left: 45%;" class="btn btn-primary" name="update">Update</button>
        <form method="post" action="#">
            <button style="margin-left: 5%;" type="submit" name="cancel" class="btn btn-primary">Cancel</button>
        </form>
    </form>
</body>
</html>
