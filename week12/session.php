
<?php

session_start();

// Store session variables
if (isset($_POST['login'])) {

    $_SESSION['username'] = $_POST['username'];

}

// Destroy session
if (isset($_GET['logout'])) {

    session_unset();
    session_destroy();

    header("Location: session.php");
    exit;

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Session Management</title>
</head>
<body>

    <h2>PHP Session Management</h2>

    <?php if (isset($_SESSION['username'])): ?>

        <h3>
            Welcome,
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </h3>

        <p>Session is active.</p>

        <a href="session.php?logout=1">Logout</a>

    <?php else: ?>

        <form method="POST">

            Enter Username:
            <input type="text" name="username" required>

            <br><br>

            <button type="submit" name="login">
                Login
            </button>

        </form>

    <?php endif; ?>

</body>
</html>
