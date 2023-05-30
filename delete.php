<?php
session_start();

include_once 'Connections/connections.php';
$con = connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['confirm_delete'])) {
        $query = "DELETE FROM student_records WHERE id = $id";


        if ($con->query($query) === TRUE) {
            header("Location: index.php");
            exit();
        }

    } elseif (isset($_POST['cancel_delete'])) {
        echo "<script>history.back();</script>";
        exit();
    }

    $selectQuery = "SELECT * FROM student_records WHERE id = $id";
    $result = $con->query($selectQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['First_name'] . ' ' . $row['Middle_name'] . ' ' . $row['Surname'];
        ?>

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="./css/delete.css">
            <title>Add New Student</title>
        </head>

        <body>
            <div class="container">
                <h2>Delete Confirmation</h2>
                <p>Are you sure you want to delete the student record for "
                    <?php echo $name; ?>"?
                </p>

                <form method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="confirm_delete" value="Delete">
                    <button type="button" onclick="history.back()">Go Back</button>
                </form>
            </div>
        </body>

        </html>

        <?php
    } else {
        // If no student record found with the provided ID, display an error message
        echo "Invalid student ID";
    }
} else {
    // If the student ID is not provided, display an error message
    echo "Invalid request";
}
?>