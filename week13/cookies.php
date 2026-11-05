
<?php

// Set cookie when form is submitted
if (isset($_POST['save'])) {

    $name = $_POST['username'];

    setcookie("username", $name, time() + 3600, "/");

    header("Location: cookies.php");
    exit;

}

// Delete cookie
if (isset($_GET['delete'])) {

    setcookie("username", "", time() - 3600, "/");

    header("Location: cookies.php");
    exit;

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Cookies</title>
</head>
<body>

    <h2>PHP Cookie Management</h2>

    <?php

    if (isset($_COOKIE['username'])) {

        echo "Welcome, " .
             htmlspecialchars($_COOKIE['username']);

        echo "<br><br>";

        echo '<a href="cookies.php?delete=1">Delete Cookie</a>';

    } else {

    ?>

        <form method="POST">

            Enter Your Name:

            <input type="text" name="username" required>

            <br><br>

            <button type="submit" name="save">
                Save Preference
            </button>

        </form>

    <?php } ?>

</body>
</html>
