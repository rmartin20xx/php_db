<?php
session_start();
if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") {
    echo "Welcome " . $_SESSION['UserLogin'] . "<br><br>";
} else {
    header("Location: index.php");
    exit();
}

include_once('Connections/connections.php');
$con = connection();

$id = $_GET['id'];

if (isset($_POST['submit'])) {
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
$students = $con->query($sql) or die ($con->error);
$row = $students->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/details.css">
    <title>Edit New Student</title>
</head>
<body>

    <div class="container">
        <form method="POST" action="">
            <p>First Name: <input type="text" name="first_name" value="<?php echo $row['First_name'];?>"></p>
            <p>Middle Name: <input type="text" name="middle_name" value="<?php echo $row['Middle_name'];?>"></p>
            <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['Surname'];?>"></p>
            <p>Gender: <input type="text" name="gender" value="<?php echo $row['Gender'];?>"></p>
            <p>Birthday: <input type="date" name="birthday" value="<?php echo $row['Birthday'];?>"></p>
            <p>Enrolled Date: <input type="date" name="enrolled_date" value="<?php echo $row['Enrolled_date'];?>"></p>
            <button type="submit" name="submit">Update Student</button>
        </form>
    </div>

</body>
</html>

