<?php
if (!isset($_SESSION)) {
    session_start();
}


include_once 'Connections/connections.php';
$con = connection();


$search = $_GET['search'];
$searchField = $_GET['searchField'];
$sortBy = $_GET['sortBy'];

$sql = "SELECT * FROM student_records WHERE $searchField LIKE '$search%' ORDER BY $searchField $sortBy";


$students = $con->query($sql) or die($con->error);
$resultCount = $students->num_rows;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Search Student Records</title>
    <style>
    </style>
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
            <a href="index.php">Index Page</a>
            <?php if (isset($_SESSION["access"]) && $_SESSION['access'] == "administrator") { ?>
                <a href="insert.php">Insert New Student Record</a>
            <?php } ?>
            <?php if (isset($_SESSION['UserLogin'])) { ?>
                <a href="logout.php">Logout</a>
            <?php } else { ?>
                <a href="login.php">Login</a>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <h1>Results for
            <?php echo $search; ?>
        </h1>
        <p>Result Count:
            <?php echo $resultCount; ?>
        </p>




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
        <?php if ($resultCount > 0): ?>
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