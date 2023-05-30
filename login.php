<?php
session_start();
include_once 'Connections/connections.php';
$con = connection();

$errorMessage = ""; // Variable to hold the error message

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user_accounts WHERE username = '$username' AND password = '$password' ";

    $user = $con->query($sql) or die($con->error);
    $row = $user->fetch_assoc();
    $total = $user->num_rows;
    

    if ($total > 0) {
        $_SESSION["UserLogin"] = $row["username"];
        $_SESSION["access"] = $row["access"];

        echo header("Location: index.php");
        exit();
    } else {
        $errorMessage = "Invalid username or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="box">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="login">Login</button>
                </div>
            </div>
        </form>

        <?php if (!empty($errorMessage)): ?>
            <div class="invalid">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>