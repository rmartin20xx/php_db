<?php
if (!isset($_SESSION)) {
    session_start();
}


include_once 'Connections/connections.php';
$con = connection();

$sql = "SELECT * FROM student_records ORDER BY id DESC";

$students = $con->query($sql) or die($con->error);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Student Records</title>

</head>

<body>
    <div class="header">
        <div class="welcome">
            <?php
            // Display the "Welcome" message
            if (isset($_SESSION["UserLogin"])) {
                echo "<p>Welcome " . $_SESSION['UserLogin'] . "</p>";
            } else {
                echo "<p>Welcome Guest</p>";
            }
            ?>
        </div>

        <div class="login">
            <?php if ((isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") || (isset($_SESSION["access"]) && $_SESSION['access'] == "user")) { ?>
                <a href="insert.php">Add New Student Record</a>
            <?php } ?>
            <?php if (isset($_SESSION['UserLogin'])) { ?>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <h1>Student Records</h1>
        <hr>

        <?php
        // Fetch all student records
        $query = "SELECT * FROM student_records ORDER BY id DESC";

        $result = $con->query($query);

        if ($result->num_rows > 0):
            ?>
            <div class="searchbox">
                <form action="result.php" method="get">
                    <p>Search: <input type="text" name="search" id="search">
                        <select name="searchField">
                            <option value="id">ID</option>
                            <option value="First_name">First Name</option>
                            <option value="Middle_name">Middle Name</option>
                            <option value="Surname">Last Name</option>
                            <option value="Gender">Gender</option>
                            <!-- <option value="Birthday">Birthday</option>
                            <option value="Enrolled_date">Enrolled Date</option> -->
                        </select>
                        <select name="sortBy" id="sort-select">
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select>
                        <button type="submit">Search</button>
                </form>
            </div>
            <hr>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Surname</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Enrolled Date</th>
                    <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
                        <th>Date Created</th>
                        <th>Date Modified</th>
                    <?php } ?>
                    <?php if ((isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") || (isset($_SESSION["access"]) && $_SESSION['access'] == "user")) { ?>
                        <th>View</th>
                    <?php } ?>
                    <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
                        <th>Edit</th>
                        <th>Delete</th>
                    <?php } ?>
                </tr>

                <?php while ($row = $students->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo $row['First_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['Middle_name']; ?>
                        </td>
                        <td>
                            <?php echo $row['Surname']; ?>
                        </td>
                        <td>
                            <?php echo $row['Gender']; ?>
                        </td>

                        <td>
                            <?php echo $row['Birthday']; ?>
                        </td>
                        <td>
                            <?php echo $row['Enrolled_date']; ?>
                        </td>
                        <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
                            <td>
                                <?php echo $row['date_created']; ?>
                            </td>
                            <td>
                                <?php echo $row['date_modified']; ?>
                            </td>
                        <?php } ?>
                        <?php if ((isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") || (isset($_SESSION["access"]) && $_SESSION['access'] == "user")) { ?>
                            <td><a href="details.php?id=<?php echo $row['id']; ?>">View</a></td>
                        <?php } ?>

                        <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
                            <td><a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No student records found.</p>
        <?php endif; ?>
    </div>
</body>

</html>