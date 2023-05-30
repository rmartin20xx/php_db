<?php



include_once("Connections/connections.php");
$con = connection();

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $enrolled_date = $_POST['enrolled_date'];

    $sql ="INSERT INTO student_records (First_name, Middle_name, Surname, Gender, Birthday, Enrolled_date) VALUES ('$first_name', '$middle_name', '$last_name','$gender', '$birthday', '$enrolled_date')";
    $con->query($sql) or die($con->error);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/insert.css">
    <title>Add New Student</title>
</head>

<body>
    <h1>Student Records</h1>

    <div class="container">
        <h2>Add New Student</h2>
        <a href="index.php">Index</a>
        <form method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" required><br>

            <label for="middle_name">Middle Name:</label>
            <input type="text" name="middle_name" id="middle_name" required><br>

            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" required><br>

            <label for="gender">Gender:</label>
            <select name="gender" id="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>

            <label for="birthday">Birthday:</label>
            <input type="date" name="birthday" id="birthday" required><br>

            <label for="enrolled_date">Enrolled Date:</label>
            <input type="date" name="enrolled_date" id="enrolled_date" required><br>

            <button type="submit" name="submit">Add Student</button>
        </form>
    </div>
</body>

</html>
