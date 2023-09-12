<?php
require 'db.php';

// CREATE operation - Add new feedback
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $insert_query = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($con, $insert_query)) {
        echo "Feedback added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// READ operation - Fetch all feedback
$feedback_query = mysqli_query($con, "SELECT * FROM feedback");
$feedback_data = mysqli_fetch_all($feedback_query, MYSQLI_ASSOC);

// UPDATE operation - Edit existing feedback
if (isset($_POST['update'])) {
    $feedback_id = $_POST['feedback_id'];
    $updated_name = mysqli_real_escape_string($con, $_POST['updated_name']);
    $updated_email = mysqli_real_escape_string($con, $_POST['updated_email']);
    $updated_message = mysqli_real_escape_string($con, $_POST['updated_message']);

    $update_query = "UPDATE feedback SET name='$updated_name', email='$updated_email', message='$updated_message' WHERE id=$feedback_id";
    if (mysqli_query($con, $update_query)) {
        echo "Feedback updated successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// DELETE operation - Delete feedback
if (isset($_POST['delete'])) {
    $feedback_id = $_POST['feedback_id'];

    $delete_query = "DELETE FROM feedback WHERE id=$feedback_id";
    if (mysqli_query($con, $delete_query)) {
        echo "Feedback deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback CRUD</title>
    <style>
       
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1, h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
 



        </style>
</head>
<body>
    <h1>Feedback Form</h1>
    <h2>Delete Feedback</h2>
    <form method="post" action="">
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Message:</label>
        <textarea name="message" required></textarea><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>Feedback List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($feedback_data as $feedback) : ?>
            <tr>
                <td><?php echo $feedback['id']; ?></td>
                <td><?php echo $feedback['name']; ?></td>
                <td><?php echo $feedback['email']; ?></td>
                <td><?php echo $feedback['message']; ?></td>
                <td>
                    <a href="edit_feedback.php?id=<?php echo $feedback['id']; ?>">Edit</a>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="feedback_id" value="<?php echo $feedback['id']; ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
