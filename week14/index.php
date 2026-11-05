
<?php

require "config/db.php";

// Search functionality
$search = trim($_GET['search'] ?? '');

if ($search != "") {

    $stmt = $conn->prepare(
        "SELECT * FROM students
         WHERE name LIKE :search
         OR email LIKE :search
         OR course LIKE :search
         ORDER BY id DESC"
    );

    $stmt->execute([
        ':search' => "%$search%"
    ]);

} else {

    $stmt = $conn->query(
        "SELECT * FROM students ORDER BY id DESC"
    );

}

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Student Management System</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <div class="container">

        <h1>Student Management System</h1>

        <p class="subtitle">
            Manage Student Records Easily
        </p>

        <a href="add_student.php" class="btn">
            + Add New Student
        </a>

        <form method="GET" class="search-form">

            <input
                type="text"
                name="search"
                placeholder="Search by name, email or course"
                value="<?php echo e($search); ?>"
            >

            <button type="submit">Search</button>

            <a href="index.php" class="reset-btn">Reset</a>

        </form>

        <h2>Student Records</h2>

        <table>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>

            <?php if (count($students) > 0): ?>

                <?php foreach ($students as $student): ?>

                    <tr>

                        <td><?php echo e($student['id']); ?></td>

                        <td><?php echo e($student['name']); ?></td>

                        <td><?php echo e($student['email']); ?></td>

                        <td><?php echo e($student['phone']); ?></td>

                        <td><?php echo e($student['course']); ?></td>

                        <td>

                            <a
                                href="edit_student.php?id=<?php echo e($student['id']); ?>"
                                class="edit-btn"
                            >
                                Edit
                            </a>

                            <form
                                action="delete_student.php"
                                method="POST"
                                class="inline-form"
                                onsubmit="return confirmDelete();"
                            >

                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo e($student['id']); ?>"
                                >

                                <button
                                    type="submit"
                                    class="delete-btn"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6">No students found.</td>
                </tr>

            <?php endif; ?>

        </table>

    </div>

    <script src="js/script.js"></script>

</body>
</html>
