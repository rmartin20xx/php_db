<?php
session_start();

include_once('Connections/connections.php');
$con = connection();

$id = $_GET['id'];

if (isset($_POST['Update'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $enrolled_date = $_POST['enrolled_date'];

    $sql = "UPDATE `student_records` SET
        `First_name` = '$first_name',
        `Middle_name` = '$middle_name',
        `Surname` = '$last_name',
        `Gender` = '$gender',
        `Birthday` = '$birthday',
        `Enrolled_date` = '$enrolled_date',
        `date_modified` = NOW()
        WHERE `id` = '$id'";

    if ($con->query($sql)) {
        echo "Student records updated successfully.";
        header("Location: index.php");
    } else {
        echo "Error updating student records: " . $con->error;
    }
}

$sql = "SELECT * FROM student_records WHERE id = '$id'";
$students = $con->query($sql) or die($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/edit.css">
    <title>Edit New Student</title>
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
        <h1>Edit Record of Student
            <?php echo $row['First_name']; ?>
            <?php echo $row['Middle_name']; ?>
            <?php echo $row['Surname'] ?>
        </h1>
        <form method="POST" action="">
            <p>First Name: <input type="text" name="first_name" value="<?php echo $row['First_name']; ?>"></p>
            <p>Middle Name: <input type="text" name="middle_name" value="<?php echo $row['Middle_name']; ?>"></p>
            <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['Surname']; ?>"></p>
            <p>Gender: <select name="gender" id="gender" required>
                    <option value="Male" <?php if ($row['Gender'] == 'Male')
                        echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($row['Gender'] == 'Female')
                        echo 'selected'; ?>>Female</option>
                </select><br>
            </p>
            <p>Birthday: <input type="date" name="birthday" value="<?php echo $row['Birthday']; ?>"></p>
            <p>Enrolled Date: <input type="date" name="enrolled_date" value="<?php echo $row['Enrolled_date']; ?>"></p>
            <button type="submit" name="Update">Update Student</button>
        </form>
        <a href="details.php?id=<?php echo $row['id']; ?>">View</a>
        <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
        <?php } ?>
    </div>

</body>

</html>