
<?php

require "config/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');

    // Validate input
    if ($name == "" || $email == "" || $phone == "" || $course == "") {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email.";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO students (name, email, phone, course)
             VALUES (:name, :email, :phone, :course)"
        );

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course
        ]);

        header("Location: index.php");
        exit;

    }

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Student</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">

        <h1>Add New Student</h1>

        <?php if ($error != ""): ?>

            <p class="error"><?php echo e($error); ?></p>

        <?php endif; ?>

        <form method="POST" onsubmit="return validateForm();">

            <label>Student Name</label>

            <input
                type="text"
                name="name"
                id="name"
                value="<?php echo e($_POST['name'] ?? ''); ?>"
                required
            >

            <label>Email Address</label>

            <input
                type="email"
                name="email"
                value="<?php echo e($_POST['email'] ?? ''); ?>"
                required
            >

            <label>Phone Number</label>

            <input
                type="text"
                name="phone"
                id="phone"
                value="<?php echo e($_POST['phone'] ?? ''); ?>"
                required
            >

            <label>Course</label>

            <input
                type="text"
                name="course"
                value="<?php echo e($_POST['course'] ?? ''); ?>"
                required
            >

            <button type="submit">Add Student</button>

        </form>

        <a href="index.php" class="back-btn">Back to Home</a>

    </div>

    <script src="js/script.js"></script>

</body>
</html>
