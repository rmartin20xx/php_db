<?php
session_start();

include_once('Connections/connections.php');
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM student_records WHERE id = '$id'";

$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc()
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/details.css">
    <title>Add New Student</title>
</head>


<body>
    <div class="header">
        <div class="welcome">
        </div>
        <div class="login">
                <a href="index.php">Main Page</a>
            <a href="logout.php">Logout</a>

        </div>
    </div>
    <div class="container">
        <h1>View ID No:
            <?php echo $row['id']; ?>
        </h1>
        <h2>Name:
            <?php echo $row['First_name']; ?>
            <?php echo $row['Middle_name']; ?>
            <?php echo $row['Surname'] ?>
        </h2>
        <p>Gender:
            <?php echo $row['Gender']; ?>
        </p>
        <p>Birthday:
            <?php echo $row['Birthday']; ?>
        </p>
        <p>Enrolled Date:
            <?php echo $row['Enrolled_date']; ?>
        </p>

        <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        <?php } ?>

    </div>
</body>

</html>