
<?php

require "config.php";

// CREATE operation
if (isset($_POST['add'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO students (name, email)
            VALUES (:name, :email)";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':name' => $name,
        ':email' => $email
    ]);

    header("Location: crud.php");
    exit;
}

// UPDATE operation
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE students
            SET name = :name, email = :email
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':id' => $id
    ]);

    header("Location: crud.php");
    exit;
}

// DELETE operation
if (isset($_POST['delete'])) {

    $id = $_POST['id'];

    $stmt = $conn->prepare(
        "DELETE FROM students WHERE id = :id"
    );

    $stmt->execute([':id' => $id]);

    header("Location: crud.php");
    exit;
}

// Get record for editing
$editStudent = null;

if (isset($_GET['edit'])) {

    $id = $_GET['edit'];

    $stmt = $conn->prepare(
        "SELECT * FROM students WHERE id = :id"
    );

    $stmt->execute([':id' => $id]);

    $editStudent = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD Operations</title>
</head>
<body>

    <h2>Student Management System</h2>

    <h3>
        <?php echo $editStudent ? "Update Student" : "Add Student"; ?>
    </h3>

    <form method="POST">

        <?php if ($editStudent): ?>

            <input type="hidden" name="id"
                value="<?php echo htmlspecialchars($editStudent['id']); ?>">

        <?php endif; ?>

        Name:
        <input type="text" name="name"
            value="<?php echo htmlspecialchars($editStudent['name'] ?? ''); ?>"
            required>

        <br><br>

        Email:
        <input type="email" name="email"
            value="<?php echo htmlspecialchars($editStudent['email'] ?? ''); ?>"
            required>

        <br><br>

        <?php if ($editStudent): ?>

            <button type="submit" name="update">Update</button>

            <a href="crud.php">Cancel</a>

        <?php else: ?>

            <button type="submit" name="add">Add Student</button>

        <?php endif; ?>

    </form>

    <hr>

    <h3>Student Records</h3>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <?php

        // READ operation
        $stmt = $conn->query("SELECT * FROM students");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        ?>

        <tr>

            <td><?php echo htmlspecialchars($row['id']); ?></td>

            <td><?php echo htmlspecialchars($row['name']); ?></td>

            <td><?php echo htmlspecialchars($row['email']); ?></td>

            <td>

                <a href="crud.php?edit=<?php echo $row['id']; ?>">
                    Edit
                </a>

                <form method="POST" style="display:inline;">

                    <input type="hidden" name="id"
                        value="<?php echo htmlspecialchars($row['id']); ?>">

                    <button type="submit" name="delete">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        <?php } ?>

    </table>

</body>
</html>
