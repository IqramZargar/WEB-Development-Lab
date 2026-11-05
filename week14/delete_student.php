
<?php

require "config/db.php";

// Accept only POST requests
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(405);
    exit("Method not allowed.");
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid student ID.");
}

// Delete student record
$stmt = $conn->prepare(
    "DELETE FROM students WHERE id = :id"
);

$stmt->execute([':id' => $id]);

// Return to main page
header("Location: index.php");
exit;

?>
