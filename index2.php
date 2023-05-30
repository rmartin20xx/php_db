<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Student Records</title>
    <style>

    </style>
</head>
<body>
    <h1>Student Records</h1>

    <?php
    // Include the database connection file
    include_once 'Connections/db_connect.php';
    // $con = connection();

    // Fetch all student records
    $query = "SELECT * FROM student_records ORDER BY id DESC";

    $result = $connection->query($query);

    if ($result->num_rows > 0) :
    ?>
    <a href="insert.php">Insert New Student Record</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Enrolled Date</th>
                    <th>Date Created</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['First_name']; ?></td>
                        <td><?php echo $row['Surname']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['Birthday']; ?></td>
                        <td><?php echo $row['Enrolled_date']; ?></td>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><button>DELETE</button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No student records found.</p>
    <?php endif; ?>

    <?php
    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
