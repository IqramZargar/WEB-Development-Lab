
<?php

require "config/db.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid student ID.");
}

// Fetch existing student
$stmt = $conn->prepare(
    "SELECT * FROM students WHERE id = :id"
);

$stmt->execute([':id' => $id]);

$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    die("Student not found.");
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if ($name == "" || $email == "" || $phone == "" || $course == "") {

        $error = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Enter a valid email address.";

    } else {

        $stmt = $conn->prepare(
            "UPDATE students
             SET name = :name,
                 email = :email,
                 phone = :phone,
                 course = :course
             WHERE id = :id"
        );

        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':course' => $course,
            ':id' => $id
        ]);

        header("Location: index.php");
        exit;

    }

    // Keep submitted values if validation fails
    $student['name'] = $name;
    $student['email'] = $email;
    $student['phone'] = $phone;
    $student['course'] = $course;

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Student</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="form-container">

        <h1>Edit Student Details</h1>

        <?php if ($error != ""): ?>

            <p class="error"><?php echo e($error); ?></p>

        <?php endif; ?>

        <form method="POST">

            <label>Student Name</label>

            <input
                type="text"
                name="name"
                value="<?php echo e($student['name']); ?>"
                required
            >

            <label>Email Address</label>

            <input
                type="email"
                name="email"
                value="<?php echo e($student['email']); ?>"
                required
            >

            <label>Phone Number</label>

            <input
                type="text"
                name="phone"
                value="<?php echo e($student['phone']); ?>"
                required
            >

            <label>Course</label>

            <input
                type="text"
                name="course"
                value="<?php echo e($student['course']); ?>"
                required
            >

            <button type="submit">Update Student</button>

        </form>

        <a href="index.php" class="back-btn">Back to Home</a>

    </div>

</body>
</html>
