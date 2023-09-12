<?php
require 'db.php';
date_default_timezone_set('Asia/Kolkata');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $comments = $_POST['comments'];
    $feedback = $_POST['feedback'];
    $date = date('Y-m-d H:i:s'); // Get the current date and time

    $query = "INSERT INTO feedback (name, comments, feedback, date) VALUES ('$name', '$comments', '$feedback', '$date')";
    $exec = mysqli_query($con, $query);

    if ($exec) {
        // Feedback inserted successfully
        header("location:view_feedback.php"); // Redirect to the feedback view page
        exit();
    } else {
        // Error occurred during insertion
        echo 'Error: ' . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
    /* Apply styles to the form container */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f7f7f7;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Style form labels */
label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Style input fields and textareas */
input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
textarea:focus {
    border-color: #007bff; /* Highlight input fields on focus */
}

/* Style the submit button */
button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s;
}

/* Style the submit button on hover */
button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Center the form heading */
h2 {
    text-align: center;
    padding-bottom: 20px;
}

/* Style the navigation links */
.nav {
    background-color: blue;
    color: white;
    font-size: 24px;
    width: 100%;
    position: fixed;
}

.nav a {
    color: white;
    font-size: 18px;
    text-decoration: none;
    padding: 10px;
}

/* Style form validation errors */
.error {
    color: red;
    font-weight: bold;
    margin-top: 10px;
}

/* Add padding to the form container on small screens */
@media (max-width: 600px) {
    form {
        padding: 20px 10px;
    }
}

    </style>
</head>
<body>
    <nav class="nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link active" href="admin-panel.php">Home</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="analysis.php">Analysis</a>
    </nav>
    <h2 style="top: 5%;">Add Feedback</h2>
    <form method="POST" action="add_feedback.php"> <!-- Create a new PHP file "add_feedback.php" for processing the form -->
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <label>Comments</label>
            <textarea class="form-control" name="comments" placeholder="Your Comments" required></textarea>
        </div>
        <div class="form-group">
            <label>Feedback</label>
            <textarea class="form-control" name="feedback" placeholder="Your Feedback" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit Feedback</button>
    </form>
</body>
</html>
